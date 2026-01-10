<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Throwable;

class OrderController extends Controller
{
    public function showRecentOrder(Request $request)
    {
        try {
            $perPage = $request->get('per_page', 10); // default 10

            $query = Order::query();

            // Filter by status
            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }

            // Filter by customer
            if ($request->filled('customer_id')) {
                $query->where('customer_id', $request->customer_id);
            }

            // Filter by date range
            if ($request->filled('date_from') && $request->filled('date_to')) {
                $query->whereBetween('created_at', [
                    $request->date_from,
                    $request->date_to
                ]);
            }

            // Recent orders (last 7 days)
            if ($request->boolean('recent')) {
                $query->where('created_at', '>=', now()->subDays(7));
            }

            $orders = $query->latest()->paginate($perPage);

            if ($orders->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No orders found.',
                    'data' => [],
                    'meta' => null
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Orders retrieved successfully.',
                'data' => $orders->items(),
                'meta' => [
                    'current_page' => $orders->currentPage(),
                    'last_page'    => $orders->lastPage(),
                    'per_page'     => $orders->perPage(),
                    'total'        => $orders->total(),
                ]
            ], 200);
        } catch (Throwable $e) {
            Log::error('Order Pagination Error', [
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve orders.'
            ], 500);
        }
    }

    public function createOrder(Request $request)
    {
        try {
            // 1. Validate request
            $validated = $request->validate([
                'customer_id' => 'required|integer|exists:customers,id',
                'total_amount' => 'required|numeric|min:0',
                'status' => 'required|string|in:pending,processing,completed,cancelled',
                'note' => 'nullable|string',
            ]);

            // 2. Create order
            $order = Order::create($validated);

            // 3. Response
            return response()->json([
                'success' => true,
                'message' => 'Order created successfully.',
                'data' => $order
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors()
            ], 422);
        } catch (Throwable $e) {
            Log::error('Order Create Error', [
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to create order.'
            ], 500);
        }
    }

    public function updateOrder(Request $request, $id)
    {
        try {
            // 1. Find order
            $order = Order::find($id);

            if (!$order) {
                return response()->json([
                    'success' => false,
                    'message' => 'Order not found.'
                ], 404);
            }

            // 2. Validate request (partial update allowed)
            $validated = $request->validate([
                'customer_id'  => 'sometimes|integer|exists:customers,id',
                'total_amount' => 'sometimes|numeric|min:0',
                'status'       => 'sometimes|string|in:pending,processing,completed,cancelled',
                'note'         => 'nullable|string',
            ]);

            // 3. Update order
            $order->update($validated);

            // 4. Response
            return response()->json([
                'success' => true,
                'message' => 'Order updated successfully.',
                'data'    => $order->fresh()
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors'  => $e->errors()
            ], 422);
        } catch (Throwable $e) {
            Log::error('Order Update Error', [
                'order_id' => $id,
                'error'    => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to update order.'
            ], 500);
        }
    }

    public function deleteOrder($id)
    {
        try {
            // 1. Find order
            $order = Order::find($id);

            if (!$order) {
                return response()->json([
                    'success' => false,
                    'message' => 'Order not found.'
                ], 404);
            }

            // (Optional) Prevent deleting completed orders
            if ($order->status === 'completed') {
                return response()->json([
                    'success' => false,
                    'message' => 'Completed orders cannot be deleted.'
                ], 403);
            }

            // 2. Delete order
            $order->delete();

            return response()->json([
                'success' => true,
                'message' => 'Order deleted successfully.'
            ], 200);
        } catch (Throwable $e) {
            Log::error('Order Delete Error', [
                'order_id' => $id,
                'error'    => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to delete order.'
            ], 500);
        }
    }
}
