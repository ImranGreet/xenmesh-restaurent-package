<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Throwable;

class ProductController extends Controller
{
    /**
     * Get products with filters & pagination
     */
    public function index(Request $request)
    {
        try {
            $perPage = (int) $request->get('per_page', 10);

            $query = Product::query();

            /**
             * 🔍 Search (English + Bangla name)
             */
            if ($request->filled('search')) {
                $search = $request->search;

                $query->where(function ($q) use ($search) {
                    $q->where('name_en', 'like', "%{$search}%")
                        ->orWhere('name_bn', 'like', "%{$search}%");
                });
            }

            /**
             * 📂 Category filter
             */
            if ($request->filled('category_id')) {
                $query->where('category_id', $request->category_id);
            }

            /**
             * 🔘 Status filter (0 | 1)
             */
            if ($request->filled('status')) {
                $query->where('status', (int) $request->status);
            }

            /**
             * 💰 Price range filter
             */
            if (
                $request->filled('price_from') &&
                $request->filled('price_to')
            ) {
                $query->whereBetween('price', [
                    $request->price_from,
                    $request->price_to
                ]);
            }

            /**
             * ↕ Sorting (ASC | DESC)
             */
            $allowedSorts = ['created_at', 'price', 'name_en'];
            $sortBy  = in_array($request->sort_by, $allowedSorts)
                ? $request->sort_by
                : 'created_at';

            $sortDir = $request->sort_dir === 'asc' ? 'asc' : 'desc';



            $products = $query
                ->orderBy($sortBy, $sortDir)
                ->paginate($perPage);

            return response()->json([
                'success' => true,
                'data' => $products->items(),
                'meta' => [
                    'current_page' => $products->currentPage(),
                    'last_page'    => $products->lastPage(),
                    'per_page'     => $products->perPage(),
                    'total'        => $products->total(),
                ]
            ], 200);
        } catch (Throwable $e) {

            Log::error('Product Fetch Error', [
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve products'
            ], 500);
        }
    }


    /**
     * Create product
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name_en'        => 'required|string|max:255',
                'name_bn'        => 'nullable|string|max:255',
                'category_id' => 'required|integer|exists:categories,id',
                'unit_id'     => 'nullable|integer|exists:restaurant_units,id',
                'price'       => 'required|numeric|min:0',
                'stock'       => 'nullable|integer|min:0',
                'status'      => 'nullable|in:0,1',
                'description_en' => 'nullable|string',
                'description_bn' => 'nullable|string',
                'product_thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:1024',
            ]);

            /* 🖼 Image upload */
            if ($request->hasFile('product_thumbnail')) {
                $validated['product_thumbnail'] =
                    $request->file('product_thumbnail')
                    ->store('products', 'public');
            }

            $product = Product::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Product created successfully.',
                'data'    => $product
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors'  => $e->errors(),
            ], 422);
        } catch (Throwable $e) {
            Log::error('Product Create Error', ['error' => $e]);

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(), // 👈 keep during dev
            ], 500);
        }
    }


    /**
     * Update product
     */
    public function update(Request $request, $id)
    {
        try {
            $product = Product::find($id);

            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product not found.'
                ], 404);
            }

            $validated = $request->validate([
                'name_en'        => 'required|string|max:255',
                'name_bn'        => 'nullable|string|max:255',
                'category_id' => 'required|integer|exists:categories,id',
                'unit_id'     => 'nullable|integer|exists:restaurant_units,id',
                'price'       => 'required|numeric|min:0',
                'stock'       => 'nullable|integer|min:0',
                'status'      => 'nullable|in:0,1',
                'description_en' => 'nullable|string',
                'description_bn' => 'nullable|string',
                'product_thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:1024',
            ]);

            // ✅ Handle thumbnail replacement
            if ($request->hasFile('product_thumbnail')) {
                // Delete old thumbnail if exists
                if ($product->product_thumbnail && Storage::disk('public')->exists($product->product_thumbnail)) {
                    Storage::disk('public')->delete($product->product_thumbnail);
                }

                // Store new thumbnail
                $validated['product_thumbnail'] = $request->file('product_thumbnail')->store('products', 'public');
            } else {
                // Keep old thumbnail if no new image uploaded
                unset($validated['product_thumbnail']);
            }


            $product->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Product updated successfully.',
                'data' => $product->fresh()
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors()
            ], 422);
        } catch (Throwable $e) {
            Log::error('Product Update Error', [
                'product_id' => $id,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to update product.'
            ], 500);
        }
    }

    /**
     * Delete product
     */
    public function destroy($id)
    {
        try {
            $product = Product::find($id);

            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product not found.'
                ], 404);
            }

            // Delete thumbnail if exists
            if ($product->product_thumbnail && Storage::disk('public')->exists($product->product_thumbnail)) {
                Storage::disk('public')->delete($product->product_thumbnail);
            }

            $product->delete();

            return response()->json([
                'success' => true,
                'message' => 'Product deleted successfully.'
            ], 200);
        } catch (Throwable $e) {
            Log::error('Product Delete Error', [
                'product_id' => $id,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to delete product.'
            ], 500);
        }
    }


    public function toggleStatus($id)
    {
        try {
            $product = Product::find($id);

            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product not found.'
                ], 404);
            }

            // Toggle status
            $product->status = $product->status === 1 ? 0 : 1;
            $product->save();

            return response()->json([
                'success' => true,
                'message' => 'Product status updated successfully.',
                'data' => $product->fresh()
            ], 200);
        } catch (Throwable $e) {
            Log::error('Product Status Toggle Error', [
                'product_id' => $id,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to update product status.'
            ], 500);
        }
    }
}
