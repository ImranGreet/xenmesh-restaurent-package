<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $expenseCategories = [
            ['name_en' => 'Kitchen', 'name_bn' => 'রান্না', 'type' => 'expense'],
            ['name_en' => 'Spices', 'name_bn' => 'মসলা', 'type' => 'expense'],
            ['name_en' => 'Condiments', 'name_bn' => 'সস/বাটা', 'type' => 'expense'],
            ['name_en' => 'Utility', 'name_bn' => 'জ্বালানি', 'type' => 'expense'],
            ['name_en' => 'Cleaning', 'name_bn' => 'পরিষ্কার', 'type' => 'expense'],
            ['name_en' => 'Packaging', 'name_bn' => 'প্যাকেজিং', 'type' => 'expense'],
            ['name_en' => 'Staff', 'name_bn' => 'স্টাফ', 'type' => 'expense'],
            ['name_en' => 'Office', 'name_bn' => 'অফিস', 'type' => 'expense'],
            ['name_en' => 'Maintenance', 'name_bn' => 'মেরামত', 'type' => 'expense'],
            ['name_en' => 'Marketing', 'name_bn' => 'প্রচার', 'type' => 'expense'],
        ];

        // Product Categories
        $productCategories = [
            ['name_en' => 'Pizza', 'name_bn' => 'পিৎজা', 'type' => 'product'],
            ['name_en' => 'Biryani', 'name_bn' => 'বিরিয়ানি', 'type' => 'product'],
            ['name_en' => 'Burger', 'name_bn' => 'বার্গার', 'type' => 'product'],
            ['name_en' => 'Pasta & Noodles', 'name_bn' => 'পাস্তা / নুডলস', 'type' => 'product'],
            ['name_en' => 'Snacks & Appetizers', 'name_bn' => 'স্ন্যাকস / অ্যাপেটাইজার', 'type' => 'product'],
            ['name_en' => 'Drinks & Beverages', 'name_bn' => 'পানীয়', 'type' => 'product'],
            ['name_en' => 'Desserts & Ice Cream', 'name_bn' => 'ডেজার্ট / আইসক্রিম', 'type' => 'product'],
            ['name_en' => 'Sides & Extras', 'name_bn' => 'সাইড / এক্সট্রা', 'type' => 'product'],
            ['name_en' => 'Combo Meals', 'name_bn' => 'কম্বো মিল', 'type' => 'product'],
            ['name_en' => 'Kebab & Grill', 'name_bn' => 'কাবাব / গ্রিল', 'type' => 'product'],
        ];

        $allCategories = array_merge($expenseCategories, $productCategories);

        foreach ($allCategories as $category) {
            DB::table('categories')->insert([
                'name_en' => $category['name_en'],
                'name_bn' => $category['name_bn'],
                'slug' => Str::slug($category['name_en']),
                'type' => $category['type'],
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}



