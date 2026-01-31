<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function retriveProductCategories()
    {
        $productCategories = Category::where('type', 'product')->get();
        return response()->json([
            'success' => true,
            'data' => $productCategories
        ]);
    }
}
