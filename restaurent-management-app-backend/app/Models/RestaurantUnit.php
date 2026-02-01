<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantUnit extends Model
{

    protected $table = 'restaurant_units';

    protected $fillable = [
        'name',
    ];
}
