<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Throwable;

class StaffController extends Controller
{
    /**
     * Get staff list with filters & pagination
     */
    public function index(Request $request)
    {
        try {
            $perPage = $request->get('per_page', 10);

            $query = Staff::query();

            // Search by name or phone
            if ($request->filled('search')) {
                $query->where(function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->search . '%')
                      ->orWhere('phone', 'like', '%' . $request->search . '%');
                });
            }

            // Filter by role
            if ($request->filled('role')) {
                $query->where('role', $request->role);
            }

            // Filter by status
            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }

            $staffs = $query->latest()->paginate($perPage);

            if ($staffs->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No staff found.',
                    'data' => [],
                    'meta' => null
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Staff retrieved successfully.',
                'data' => $staffs->items(),
                'meta' => [
                    'current_page' => $staffs->currentPage(),
                    'last_page'    => $staffs->lastPage(),
                    'per_page'     => $staffs->perPage(),
                    'total'        => $staffs->total(),
                ]
            ], 200);

        } catch (Throwable $e) {
            Log::error('Staff Fetch Error', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve staff.'
            ], 500);
        }
    }

    /**
     * Create staff
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name'    => 'required|string|max:255',
                'phone'   => 'required|string|max:20|unique:staff,phone',
                'email'   => 'nullable|email|unique:staff,email',
                'role'    => 'required|string|in:manager,waiter,chef,cashier',
                'salary'  => 'required|numeric|min:0',
                'status'  => 'required|in:active,inactive',
                'address' => 'nullable|string',
            ]);

            $staff = Staff::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Staff created successfully.',
                'data' => $staff
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors()
            ], 422);

        } catch (Throwable $e) {
            Log::error('Staff Create Error', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to create staff.'
            ], 500);
        }
    }

    /**
     * Update staff
     */
    public function update(Request $request, $id)
    {
        try {
            $staff = Staff::find($id);

            if (!$staff) {
                return response()->json([
                    'success' => false,
                    'message' => 'Staff not found.'
                ], 404);
            }

            $validated = $request->validate([
                'name'    => 'sometimes|string|max:255',
                'phone'   => 'sometimes|string|max:20|unique:staff,phone,' . $id,
                'email'   => 'nullable|email|unique:staff,email,' . $id,
                'role'    => 'sometimes|string|in:manager,waiter,chef,cashier',
                'salary'  => 'sometimes|numeric|min:0',
                'status'  => 'sometimes|in:active,inactive',
                'address' => 'nullable|string',
            ]);

            $staff->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Staff updated successfully.',
                'data' => $staff->fresh()
            ], 200);

        } catch (ValidationException $e) {
            return response()->json([ 
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors()
            ], 422);

        } catch (Throwable $e) {
            Log::error('Staff Update Error', [
                'staff_id' => $id,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to update staff.'
            ], 500);
        }
    }

    /**
     * Delete staff
     */
    public function destroy($id)
    {
        try {
            $staff = Staff::find($id);

            if (!$staff) {
                return response()->json([
                    'success' => false,
                    'message' => 'Staff not found.'
                ], 404);
            }

            $staff->delete();

            return response()->json([
                'success' => true,
                'message' => 'Staff deleted successfully.'
            ], 200);

        } catch (Throwable $e) { 
            Log::error('Staff Delete Error', [
                'staff_id' => $id,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to delete staff.'
            ], 500);
        }
    }
}
