<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
            $perPage = $request->get('per_page', 10);

            $query = Product::query();

            // Search by name
            if ($request->filled('search')) {
                $query->where('name', 'like', '%' . $request->search . '%');
            }

            // Filter by category
            if ($request->filled('category_id')) {
                $query->where('category_id', $request->category_id);
            }

            // Filter by status
            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }

            // Price range
            if ($request->filled('price_from') && $request->filled('price_to')) {
                $query->whereBetween('price', [
                    $request->price_from,
                    $request->price_to
                ]);
            }

            $products = $query->latest()->paginate($perPage);

            if ($products->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No products found.',
                    'data' => [],
                    'meta' => null
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Products retrieved successfully.',
                'data' => $products->items(),
                'meta' => [
                    'current_page' => $products->currentPage(),
                    'last_page'    => $products->lastPage(),
                    'per_page'     => $products->perPage(),
                    'total'        => $products->total(),
                ]
            ], 200);

        } catch (Throwable $e) {
            Log::error('Product Fetch Error', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve products.'
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
                'name'        => 'required|string|max:255',
                'category_id' => 'required|integer|exists:categories,id',
                'price'       => 'required|numeric|min:0',
                'stock'       => 'required|integer|min:0',
                'status'      => 'required|in:active,inactive',
                'description' => 'nullable|string',
            ]);

            $product = Product::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Product created successfully.',
                'data' => $product
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors()
            ], 422);

        } catch (Throwable $e) {
            Log::error('Product Create Error', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to create product.'
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
                'name'        => 'sometimes|string|max:255',
                'category_id' => 'sometimes|integer|exists:categories,id',
                'price'       => 'sometimes|numeric|min:0',
                'stock'       => 'sometimes|integer|min:0',
                'status'      => 'sometimes|in:active,inactive',
                'description' => 'nullable|string',
            ]);

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
}



