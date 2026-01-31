<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // e.g., "Electricity Bill"
            $table->text('description')->nullable(); // Optional description
            $table->decimal('amount', 10, 2); // Expense amount
            $table->string('category')->nullable(); // Food, Utility, Salary, Misc
            $table->date('expense_date'); // When the expense occurred
            // $table->foreignId('created_by')->constrained('users'); // Who recorded the expense
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
