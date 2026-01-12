<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            // Pizza
            ['name_en' => 'Margherita Pizza', 'name_bn' => 'মার্গারিটা পিৎজা', 'category' => 'Pizza', 'price' => 500],
            ['name_en' => 'Pepperoni Pizza', 'name_bn' => 'পেপারোনি পিৎজা', 'category' => 'Pizza', 'price' => 600],
            ['name_en' => 'BBQ Chicken Pizza', 'name_bn' => 'বারবিকিউ চিকেন পিৎজা', 'category' => 'Pizza', 'price' => 650],
            ['name_en' => 'Veggie Pizza', 'name_bn' => 'ভেজি পিৎজা', 'category' => 'Pizza', 'price' => 450],
            ['name_en' => 'Cheese Burst Pizza', 'name_bn' => 'চিজ বাস্ট পিৎজা', 'category' => 'Pizza', 'price' => 700],

            // Biryani
            ['name_en' => 'Chicken Biryani', 'name_bn' => 'চিকেন বিরিয়ানি', 'category' => 'Biryani', 'price' => 250],
            ['name_en' => 'Beef Biryani', 'name_bn' => 'গরু বিরিয়ানি', 'category' => 'Biryani', 'price' => 300],
            ['name_en' => 'Mutton Biryani', 'name_bn' => 'খাসি বিরিয়ানি', 'category' => 'Biryani', 'price' => 350],
            ['name_en' => 'Egg Biryani', 'name_bn' => 'ডিম বিরিয়ানি', 'category' => 'Biryani', 'price' => 200],
            ['name_en' => 'Vegetable Biryani', 'name_bn' => 'ভেজিটেবল বিরিয়ানি', 'category' => 'Biryani', 'price' => 220],

            // Burger
            ['name_en' => 'Chicken Burger', 'name_bn' => 'চিকেন বার্গার', 'category' => 'Burger', 'price' => 180],
            ['name_en' => 'Beef Burger', 'name_bn' => 'গরু বার্গার', 'category' => 'Burger', 'price' => 200],
            ['name_en' => 'Veggie Burger', 'name_bn' => 'ভেজি বার্গার', 'category' => 'Burger', 'price' => 150],
            ['name_en' => 'Cheese Burger', 'name_bn' => 'চিজ বার্গার', 'category' => 'Burger', 'price' => 220],

            // Kebab & Grill
            ['name_en' => 'Chicken Kebab', 'name_bn' => 'চিকেন কাবাব', 'category' => 'Kebab & Grill', 'price' => 350],
            ['name_en' => 'Beef Kebab', 'name_bn' => 'গরু কাবাব', 'category' => 'Kebab & Grill', 'price' => 400],
            ['name_en' => 'Mutton Kebab', 'name_bn' => 'খাসি কাবাব', 'category' => 'Kebab & Grill', 'price' => 450],
            ['name_en' => 'Seekh Kebab', 'name_bn' => 'সিক কাবাব', 'category' => 'Kebab & Grill', 'price' => 380],
            ['name_en' => 'Tandoori Chicken', 'name_bn' => 'তন্দুরি চিকেন', 'category' => 'Kebab & Grill', 'price' => 420],
        ];

        foreach ($products as $product) {
            DB::table('products')->insert([
                'name_en' => $product['name_en'],
                'name_bn' => $product['name_bn'],
                'slug' => Str::slug($product['name_en']),
                'price' => $product['price'],
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
