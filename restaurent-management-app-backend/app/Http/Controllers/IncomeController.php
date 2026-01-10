<?php

namespace App\Http\Controllers;

use App\Models\Income;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Throwable;
class IncomeController extends Controller
{
    /**
     * Get income list with filters & pagination
     */
    public function index(Request $request)
    {
        try {
            $perPage = $request->get('per_page', 10);

            $query = Income::query();

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
                $query->whereBetween('income_date', [
                    $request->date_from,
                    $request->date_to
                ]);
            }

            $incomes = $query->latest()->paginate($perPage);

            if ($incomes->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No income records found.',
                    'data' => [],
                    'meta' => null
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Income records retrieved successfully.',
                'data' => $incomes->items(),
                'meta' => [
                    'current_page' => $incomes->currentPage(),
                    'last_page'    => $incomes->lastPage(),
                    'per_page'     => $incomes->perPage(),
                    'total'        => $incomes->total(),
                ]
            ], 200);

        } catch (Throwable $e) {
            Log::error('Income Fetch Error', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve income records.'
            ], 500);
        }
    }

    /**
     * Create income
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title'       => 'required|string|max:255',
                'category'    => 'required|string|in:order,delivery,other',
                'amount'      => 'required|numeric|min:0',
                'income_date' => 'required|date',
                'status'      => 'required|in:received,pending',
                'note'        => 'nullable|string',
            ]);

            $income = Income::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Income recorded successfully.',
                'data' => $income
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors()
            ], 422);

        } catch (Throwable $e) {
            Log::error('Income Create Error', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to create income record.'
            ], 500);
        }
    }

    /**
     * Update income
     */
    public function update(Request $request, $id)
    {
        try {
            $income = Income::find($id);

            if (!$income) {
                return response()->json([
                    'success' => false,
                    'message' => 'Income record not found.'
                ], 404);
            }

            $validated = $request->validate([
                'title'       => 'sometimes|string|max:255',
                'category'    => 'sometimes|string|in:order,delivery,other',
                'amount'      => 'sometimes|numeric|min:0',
                'income_date' => 'sometimes|date',
                'status'      => 'sometimes|in:received,pending',
                'note'        => 'nullable|string',
            ]);

            $income->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Income updated successfully.',
                'data' => $income->fresh()
            ], 200);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors()
            ], 422);

        } catch (Throwable $e) {
            Log::error('Income Update Error', [
                'income_id' => $id,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to update income record.'
            ], 500);
        }
    }

    /**
     * Delete income
     */
    public function destroy($id)
    {
        try {
            $income = Income::find($id);

            if (!$income) {
                return response()->json([
                    'success' => false,
                    'message' => 'Income record not found.'
                ], 404);
            }

            $income->delete();

            return response()->json([
                'success' => true,
                'message' => 'Income record deleted successfully.'
            ], 200);

        } catch (Throwable $e) {
            Log::error('Income Delete Error', [
                'income_id' => $id,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to delete income record.'
            ], 500);
        }
    }
}
