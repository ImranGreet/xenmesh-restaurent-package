<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\Expense;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Throwable;

class DashboardController extends Controller
{
    /**
     * Get dashboard statistics
     */
    public function stats()
    {
        try {
            // === Dates ===
            $today = Carbon::today()->toDateString();
            $startOfWeek = Carbon::now()->startOfWeek()->toDateString();
            $endOfWeek = Carbon::now()->endOfWeek()->toDateString();
            $startOfMonth = Carbon::now()->startOfMonth()->toDateString();
            $endOfMonth = Carbon::now()->endOfMonth()->toDateString();
            $startOfYear = Carbon::now()->startOfYear()->toDateString();
            $endOfYear = Carbon::now()->endOfYear()->toDateString();

            // === Daily ===
            $dailyIncome = Income::whereDate('income_date', $today)
                ->where('status', 'received')
                ->sum('amount');

            $dailyExpenses = Expense::whereDate('expense_date', $today)
                ->where('status', 'paid')
                ->sum('amount');

            // === Weekly ===
            $weeklyIncome = Income::whereBetween('income_date', [$startOfWeek, $endOfWeek])
                ->where('status', 'received')
                ->sum('amount');

            $weeklyExpenses = Expense::whereBetween('expense_date', [$startOfWeek, $endOfWeek])
                ->where('status', 'paid')
                ->sum('amount');

            // === Monthly ===
            $monthlyIncome = Income::whereBetween('income_date', [$startOfMonth, $endOfMonth])
                ->where('status', 'received')
                ->sum('amount');

            $monthlyExpenses = Expense::whereBetween('expense_date', [$startOfMonth, $endOfMonth])
                ->where('status', 'paid')
                ->sum('amount');

            // === Yearly ===
            $yearlyIncome = Income::whereBetween('income_date', [$startOfYear, $endOfYear])
                ->where('status', 'received')
                ->sum('amount');

            $yearlyExpenses = Expense::whereBetween('expense_date', [$startOfYear, $endOfYear])
                ->where('status', 'paid')
                ->sum('amount');

            // === Net Profits ===
            $dailyProfit = $dailyIncome - $dailyExpenses;
            $weeklyProfit = $weeklyIncome - $weeklyExpenses;
            $monthlyProfit = $monthlyIncome - $monthlyExpenses;
            $yearlyProfit = $yearlyIncome - $yearlyExpenses;

            // === Optional: Category-wise breakdown (monthly example) ===
            $incomeByCategory = Income::selectRaw('category, SUM(amount) as total')
                ->whereBetween('income_date', [$startOfMonth, $endOfMonth])
                ->where('status', 'received')
                ->groupBy('category')
                ->get();

            $expensesByCategory = Expense::selectRaw('category, SUM(amount) as total')
                ->whereBetween('expense_date', [$startOfMonth, $endOfMonth])
                ->where('status', 'paid')
                ->groupBy('category')
                ->get();

            // === Return response ===
            return response()->json([
                'success' => true,
                'data' => [
                    'daily' => [
                        'income' => $dailyIncome,
                        'expenses' => $dailyExpenses,
                        'profit' => $dailyProfit,
                    ],
                    'weekly' => [
                        'income' => $weeklyIncome,
                        'expenses' => $weeklyExpenses,
                        'profit' => $weeklyProfit,
                    ],
                    'monthly' => [
                        'income' => $monthlyIncome,
                        'expenses' => $monthlyExpenses,
                        'profit' => $monthlyProfit,
                    ],
                    'yearly' => [
                        'income' => $yearlyIncome,
                        'expenses' => $yearlyExpenses,
                        'profit' => $yearlyProfit,
                    ],
                    'income_by_category' => $incomeByCategory,
                    'expenses_by_category' => $expensesByCategory
                ]
            ]);
        } catch (Throwable $e) {
            Log::error('Dashboard Stats Error', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve dashboard stats.'
            ], 500);
        }
    }
}
