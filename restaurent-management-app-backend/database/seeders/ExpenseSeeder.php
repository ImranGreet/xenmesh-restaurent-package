<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Expense;
use Carbon\Carbon;

class ExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $expenses = [
            [
                'title'        => 'Electricity Bill',
                'description'  => 'Monthly electricity bill',
                'category'     => 'Utility',
                'amount'       => 4500.00,
                'expense_date' => Carbon::now()->subDays(3),
            ],
            [
                'title'        => 'Water Bill',
                'description'  => 'Water supply bill',
                'category'     => 'Utility',
                'amount'       => 1200.00,
                'expense_date' => Carbon::now()->subDays(5),
            ],
            [
                'title'        => 'Chef Salary',
                'description'  => 'Monthly salary',
                'category'     => 'Salary',
                'amount'       => 25000.00,
                'expense_date' => Carbon::now()->subMonth(),
            ],
            [
                'title'        => 'Vegetable Purchase',
                'description'  => 'Daily vegetable market',
                'category'     => 'Food',
                'amount'       => 8200.00,
                'expense_date' => Carbon::now()->subDays(1),
            ],
            [
                'title'        => 'Gas Cylinder Refill',
                'description'  => 'Kitchen gas refill',
                'category'     => 'Maintenance',
                'amount'       => 3000.00,
                'expense_date' => Carbon::now()->subDays(7),
            ],
            [
                'title'        => 'Cleaning Supplies',
                'description'  => 'Floor & utensil cleaners',
                'category'     => 'Misc',
                'amount'       => 1500.00,
                'expense_date' => Carbon::now(),
            ],
        ];

        foreach ($expenses as $expense) {
            Expense::create($expense);
        }
    }
}
