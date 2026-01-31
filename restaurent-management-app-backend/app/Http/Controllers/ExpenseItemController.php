<?php

namespace App\Http\Controllers;

use App\Models\ExpenseItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ExpenseItemController extends Controller
{
    /**
     * Display a listing of expense items.
     */
    public function index(Request $request)
    {
        $perPage   = $request->get('per_page', 10);
        $sortField = $request->get('sort_field', 'id');
        $sortOrder = $request->get('sort_order', 'asc'); // asc | desc

        $expenseItems = ExpenseItem::orderBy($sortField, $sortOrder)
            ->paginate($perPage);

        return response()->json([
            'data' => $expenseItems->items(),
            'meta' => [
                'current_page' => $expenseItems->currentPage(),
                'last_page'    => $expenseItems->lastPage(),
                'per_page'     => $expenseItems->perPage(),
                'total'        => $expenseItems->total(),
            ],
        ]);
    }


    /**
     * Store a newly created expense item.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_en'   => 'required|string|max:255',
            'name_bn'   => 'required|string|max:255',
            'category'  => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean',
        ]);

        $expenseItem = ExpenseItem::create([
            'name_en'   => $validated['name_en'],
            'name_bn'   => $validated['name_bn'],
            'slug'      => Str::slug($validated['name_en']),
            'category'  => $validated['category'] ?? null,
            'is_active' => $validated['is_active'] ?? true,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Expense item created successfully',
            'data'    => $expenseItem,
        ], 201);
    }

    /**
     * Update the specified expense item.
     */
    public function update(Request $request, $id)
    {
        $expenseItem = ExpenseItem::findOrFail($id);

        $validated = $request->validate([
            'name_en'   => 'required|string|max:255',
            'name_bn'   => 'required|string|max:255',
            'category'  => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean',
        ]);

        $expenseItem->update([
            'name_en'   => $validated['name_en'],
            'name_bn'   => $validated['name_bn'],
            'slug'      => Str::slug($validated['name_en']),
            'category'  => $validated['category'] ?? $expenseItem->category,
            'is_active' => $validated['is_active'] ?? $expenseItem->is_active,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Expense item updated successfully',
            'data'    => $expenseItem,
        ]);
    }

    /**
     * Remove the specified expense item.
     */
    public function destroy($id)
    {
        $expenseItem = ExpenseItem::findOrFail($id);
        $expenseItem->delete();

        return response()->json([
            'success' => true,
            'message' => 'Expense item deleted successfully',
        ]);
    }
}
