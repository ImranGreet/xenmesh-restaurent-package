<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Throwable;

class ExpenseController extends Controller
{
    /**
     * Get expenses with filters & pagination
     */
    public function index(Request $request)
    {
        try {
            $perPage = $request->get('per_page', 10);

            $query = Expense::query();

            // Search by title
            if ($request->filled('search')) {
                $query->where('title', 'like', '%' . $request->search . '%');
            }

            // Filter by category
            if ($request->filled('category')) {
                $query->where('category', $request->category);
            }

            // Filter by status
            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }

            // Filter by date range
            if ($request->filled('date_from') && $request->filled('date_to')) {
                $query->whereBetween('expense_date', [
                    $request->date_from,
                    $request->date_to
                ]);
            }

            $expenses = $query->latest()->paginate($perPage);

            if ($expenses->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No expenses found.',
                    'data' => [],
                    'meta' => null
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Expenses retrieved successfully.',
                'data' => $expenses->items(),
                'meta' => [
                    'current_page' => $expenses->currentPage(),
                    'last_page'    => $expenses->lastPage(),
                    'per_page'     => $expenses->perPage(),
                    'total'        => $expenses->total(),
                ]
            ], 200);
        } catch (Throwable $e) {
            Log::error('Expense Fetch Error', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve expenses.'
            ], 500);
        }
    }

    /**
     * Create expense
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title'        => 'required|string|max:255',
                'category'     => 'string',
                'amount'       => 'required|numeric|min:0',
                'expense_date' => 'required|date',
                'status'       => 'string',
                'note'         => 'nullable|string',
            ]);

            $expense = Expense::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Expense created successfully.',
                'data' => $expense
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors()
            ], 422);
        } catch (Throwable $e) {
            Log::error('Expense Create Error', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to create expense.'
            ], 500);
        }
    }

    /**
     * Update expense
     */
    public function update(Request $request, $id)
    {
        try {
            $expense = Expense::find($id);

            if (!$expense) {
                return response()->json([
                    'success' => false,
                    'message' => 'Expense not found.'
                ], 404);
            }

            $validated = $request->validate([
                'title'        => 'sometimes|string|max:255',
                'category'     => 'string',
                'amount'       => 'sometimes|numeric|min:0',
                'expense_date' => 'sometimes|date',
                'status'       => 'sometimes|in:paid,unpaid',
                'note'         => 'nullable|string',
            ]);

            $expense->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Expense updated successfully.',
                'data' => $expense->fresh()
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors()
            ], 422);
        } catch (Throwable $e) {
            Log::error('Expense Update Error', [
                'expense_id' => $id,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to update expense.'
            ], 500);
        }
    }

    /**
     * Delete expense
     */
    public function destroy($id)
    {
        try {
            $expense = Expense::find($id);

            if (!$expense) {
                return response()->json([
                    'success' => false,
                    'message' => 'Expense not found.'
                ], 404);
            }

            $expense->delete();

            return response()->json([
                'success' => true,
                'message' => 'Expense deleted successfully.'
            ], 200);
        } catch (Throwable $e) {
            Log::error('Expense Delete Error', [
                'expense_id' => $id,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to delete expense.'
            ], 500);
        }
    }
}
