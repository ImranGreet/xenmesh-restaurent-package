<?php

namespace App\Http\Controllers;

use App\Models\RestaurantUnit;
use Illuminate\Http\Request;

class RestaurantUnitController extends Controller
{
    public function retrieveUnits()
    {
        $units = RestaurantUnit::all();
        return response()->json([
            "success" => true,
            "data" => $units,
        ]);
    }
}
