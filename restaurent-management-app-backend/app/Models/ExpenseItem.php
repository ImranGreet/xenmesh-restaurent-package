<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseItem extends Model
{
    /** @use HasFactory<\Database\Factories\ExpenseItemFactory> */
    use HasFactory;

    protected $fillable = [
        'name_en',
        'name_bn',
        'slug',
        'category',
        'is_active',
    ];
}
