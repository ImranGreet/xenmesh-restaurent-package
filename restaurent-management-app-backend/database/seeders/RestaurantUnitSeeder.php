<?php

namespace Database\Seeders;

use App\Models\RestaurantUnit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestaurantUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $units = [
            ['id' => 1, 'name' => 'pcs'],
            ['id' => 2, 'name' => 'kg'],
            ['id' => 3, 'name' => 'g'],
            ['id' => 4, 'name' => 'ltr'],
            ['id' => 5, 'name' => 'ml'],
            ['id' => 6, 'name' => 'dozen'],
            ['id' => 7, 'name' => 'packet'],
            ['id' => 8, 'name' => 'box'],
            ['id' => 9, 'name' => 'cup'],
            ['id' => 10, 'name' => 'slice'],
        ];

        foreach ($units as $unit) {
            RestaurantUnit::updateOrCreate(['id' => $unit['id']], $unit); 
        }
    }
}
