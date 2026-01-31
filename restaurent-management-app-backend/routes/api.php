<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ExpenseItemController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');


Route::middleware('auth:sanctum')->group(function () {
    // Roles
    Route::get('/roles', [RolePermissionController::class, 'roles']);
    Route::post('/roles', [RolePermissionController::class, 'createRole']);
    Route::post('/roles/{id}/permissions', [RolePermissionController::class, 'assignPermissions']);

    // Permissions
    Route::get('/permissions', [RolePermissionController::class, 'permissions']);
    Route::post('/permissions', [RolePermissionController::class, 'createPermission']);
});


Route::middleware('auth:sanctum')->controller(OrderController::class)->group(function () {
    Route::get('/recent-order', 'showRecentOrder');
    Route::post('/create-order', 'createOrder');
    Route::put('/update-order/{id}', 'updateOrder');
    Route::delete('/delte-order/{id}', 'deleteOrder');
});


Route::controller(ProductController::class)->group(function () {
    Route::get('/products', 'index');
    Route::post('/create-product', 'store');
    Route::put('/update-product/{id}', 'update');
    Route::delete('/delete-product/{id}', 'destroy');
    Route::get('/update-product-status/{id}', 'toggleStatus');
});


Route::controller(StaffController::class)
    ->middleware('auth:sanctum')
    ->group(function () {

        Route::get('/staffs', 'index');
        Route::post('/create-staff', 'store');
        Route::put('/update-staff/{id}', 'update');
        Route::delete('/delete-staff/{id}', 'destroy');
    });


Route::controller(ExpenseController::class)->group(function () {

    Route::get('/expenses', 'index');
    Route::post('/create-expense', 'store');
    Route::put('/update-expense/{id}', 'update');
    Route::delete('/delete-expense/{id}', 'destroy');
});


Route::controller(ExpenseItemController::class)
    ->group(function () {

        Route::get('/expense-items', 'index');
        Route::post('/create-expense-item', 'store');
        Route::put('/update-expense-item/{id}', 'update');
        Route::delete('/delete-expense-item/{id}', 'destroy');
        Route::get('/active-expense-items', 'getActiveExpenseItems');
    });

Route::controller(IncomeController::class)
    ->middleware('auth:sanctum')
    ->group(function () {

        Route::get('/incomes', 'index');
        Route::post('/create-income', 'store');
        Route::put('/update-income/{id}', 'update');
        Route::delete('/delete-income/{id}', 'destroy');
    });

Route::controller(DashboardController::class)
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::get('/dashboard/stats', 'stats');
    });



Route::controller(CategoryController::class)->group(function () {
    Route::get('/retrieve-product-categories', 'retriveProductCategories');
});
