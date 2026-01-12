<?php

namespace Database\Seeders;

use App\Models\ExpenseItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ExpenseItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
             $items = [
            // 🥬 Kitchen Raw Materials
            ['Rice', 'চাল', 'kitchen'],
            ['Basmati Rice', 'বাসমতি চাল', 'kitchen'],
            ['Flour', 'আটা', 'kitchen'],
            ['Maida', 'ময়দা', 'kitchen'],
            ['Semolina', 'সুজি', 'kitchen'],
            ['Oil', 'তেল', 'kitchen'],
            ['Soybean Oil', 'সয়াবিন তেল', 'kitchen'],
            ['Mustard Oil', 'সরিষার তেল', 'kitchen'],
            ['Ghee', 'ঘি', 'kitchen'],
            ['Butter', 'মাখন', 'kitchen'],
            ['Onion', 'পেঁয়াজ', 'kitchen'],
            ['Garlic', 'রসুন', 'kitchen'],
            ['Ginger', 'আদা', 'kitchen'],
            ['Green Chili', 'কাঁচা মরিচ', 'kitchen'],
            ['Dry Chili', 'শুকনা মরিচ', 'kitchen'],
            ['Potato', 'আলু', 'kitchen'],
            ['Tomato', 'টমেটো', 'kitchen'],
            ['Brinjal', 'বেগুন', 'kitchen'],
            ['Cauliflower', 'ফুলকপি', 'kitchen'],
            ['Cabbage', 'বাঁধাকপি', 'kitchen'],
            ['Carrot', 'গাজর', 'kitchen'],
            ['Cucumber', 'শসা', 'kitchen'],
            ['Pumpkin', 'কুমড়া', 'kitchen'],
            ['Spinach', 'পালং শাক', 'kitchen'],
            ['Coriander Leaf', 'ধনেপাতা', 'kitchen'],
            ['Mint Leaf', 'পুদিনা পাতা', 'kitchen'],
            ['Lemon', 'লেবু', 'kitchen'],
            ['Egg', 'ডিম', 'kitchen'],
            ['Chicken', 'মুরগি', 'kitchen'],
            ['Beef', 'গরু মাংস', 'kitchen'],
            ['Mutton', 'খাসি মাংস', 'kitchen'],
            ['Fish', 'মাছ', 'kitchen'],
            ['Shrimp', 'চিংড়ি', 'kitchen'],
            ['Milk', 'দুধ', 'kitchen'],
            ['Yogurt', 'দই', 'kitchen'],
            ['Cream', 'ক্রিম', 'kitchen'],
            ['Cheese', 'চিজ', 'kitchen'],

            // 🌶️ Spices & Masala
            ['Salt', 'লবণ', 'spices'],
            ['Sugar', 'চিনি', 'spices'],
            ['Turmeric Powder', 'হলুদ গুঁড়া', 'spices'],
            ['Chili Powder', 'মরিচ গুঁড়া', 'spices'],
            ['Coriander Powder', 'ধনে গুঁড়া', 'spices'],
            ['Cumin Powder', 'জিরা গুঁড়া', 'spices'],
            ['Garam Masala', 'গরম মসলা', 'spices'],
            ['Five Spice', 'পাঁচ ফোড়ন', 'spices'],
            ['Bay Leaf', 'তেজপাতা', 'spices'],
            ['Cinnamon', 'দারুচিনি', 'spices'],
            ['Cardamom', 'এলাচ', 'spices'],
            ['Clove', 'লবঙ্গ', 'spices'],
            ['Black Pepper', 'গোলমরিচ', 'spices'],
            ['Mustard Seed', 'সরিষা', 'spices'],
            ['Fenugreek', 'মেথি', 'spices'],
            ['Tamarind', 'তেঁতুল', 'spices'],

            // 🍯 Sauce, Paste & Condiments
            ['Soy Sauce', 'সয়া সস', 'condiments'],
            ['Chili Sauce', 'চিলি সস', 'condiments'],
            ['Tomato Ketchup', 'টমেটো কেচাপ', 'condiments'],
            ['Vinegar', 'সিরকা', 'condiments'],
            ['Mayonnaise', 'মেয়োনিজ', 'condiments'],
            ['Mustard Paste', 'সরিষা বাটা', 'condiments'],
            ['Ginger Paste', 'আদা বাটা', 'condiments'],
            ['Garlic Paste', 'রসুন বাটা', 'condiments'],

            // 🔥 Utility & Fuel
            ['LPG Gas', 'এলপিজি গ্যাস', 'utility'],
            ['Gas Cylinder', 'গ্যাস সিলিন্ডার', 'utility'],
            ['Charcoal', 'কয়লা', 'utility'],
            ['Firewood', 'জ্বালানি কাঠ', 'utility'],
            ['Electricity Bill', 'বিদ্যুৎ বিল', 'utility'],
            ['Water Bill', 'পানির বিল', 'utility'],
            ['Drinking Water Jar', 'পানির জার', 'utility'],
            ['Ice', 'বরফ', 'utility'],

            // 🧽 Cleaning & Hygiene
            ['Dish Wash Liquid', 'বাসন ধোয়ার লিকুইড', 'cleaning'],
            ['Detergent Powder', 'ডিটারজেন্ট পাউডার', 'cleaning'],
            ['Bleaching Powder', 'ব্লিচিং পাউডার', 'cleaning'],
            ['Phenyl', 'ফিনাইল', 'cleaning'],
            ['Floor Cleaner', 'ফ্লোর ক্লিনার', 'cleaning'],
            ['Hand Wash', 'হ্যান্ড ওয়াশ', 'cleaning'],
            ['Tissue Paper', 'টিস্যু পেপার', 'cleaning'],
            ['Paper Towel', 'পেপার তোয়ালে', 'cleaning'],
            ['Garbage Bag', 'ময়লা ব্যাগ', 'cleaning'],
            ['Hand Gloves', 'হাতমোজা', 'cleaning'],
            ['Face Mask', 'মাস্ক', 'cleaning'],

            // 📦 Packaging & Delivery
            ['Food Box', 'ফুড বক্স', 'packaging'],
            ['Poly Bag', 'পলিথিন ব্যাগ', 'packaging'],
            ['Carry Bag', 'ক্যারি ব্যাগ', 'packaging'],
            ['Aluminum Foil', 'অ্যালুমিনিয়াম ফয়েল', 'packaging'],
            ['Paper Cup', 'পেপার কাপ', 'packaging'],
            ['Plastic Cup', 'প্লাস্টিক কাপ', 'packaging'],
            ['Straw', 'স্ট্র', 'packaging'],
            ['Spoon', 'চামচ', 'packaging'],
            ['Delivery Charge', 'ডেলিভারি চার্জ', 'packaging'],

            // 👨‍🍳 Staff & HR
            ['Staff Salary', 'স্টাফ বেতন', 'staff'],
            ['Advance Salary', 'অগ্রিম বেতন', 'staff'],
            ['Bonus', 'বোনাস', 'staff'],
            ['Overtime Payment', 'ওভারটাইম', 'staff'],
            ['Staff Meal', 'স্টাফ খাবার', 'staff'],
            ['Uniform', 'ইউনিফর্ম', 'staff'],
            ['Medical Expense', 'চিকিৎসা খরচ', 'staff'],
            ['Training Cost', 'প্রশিক্ষণ খরচ', 'staff'],

            // 🧾 Office & Admin
            ['House Rent', 'দোকান ভাড়া', 'office'],
            ['License Fee', 'লাইসেন্স ফি', 'office'],
            ['Trade License', 'ট্রেড লাইসেন্স', 'office'],
            ['VAT & Tax', 'ভ্যাট ও ট্যাক্স', 'office'],
            ['Internet Bill', 'ইন্টারনেট বিল', 'office'],
            ['Mobile Bill', 'মোবাইল বিল', 'office'],
            ['Printing Cost', 'প্রিন্টিং খরচ', 'office'],
            ['Stationery', 'স্টেশনারি', 'office'],

            // 🛠️ Maintenance & Repair
            ['Gas Stove Repair', 'চুলা মেরামত', 'maintenance'],
            ['Refrigerator Repair', 'ফ্রিজ মেরামত', 'maintenance'],
            ['Freezer Repair', 'ফ্রিজার মেরামত', 'maintenance'],
            ['AC Repair', 'এসি মেরামত', 'maintenance'],
            ['Fan Repair', 'ফ্যান মেরামত', 'maintenance'],
            ['Light Repair', 'লাইট মেরামত', 'maintenance'],
            ['Table Repair', 'টেবিল মেরামত', 'maintenance'],
            ['Chair Repair', 'চেয়ার মেরামত', 'maintenance'],
            ['Equipment Purchase', 'যন্ত্রপাতি ক্রয়', 'maintenance'],

            // 📢 Marketing & Others
            ['Facebook Promotion', 'ফেসবুক প্রচার', 'marketing'],
            ['Banner', 'ব্যানার', 'marketing'],
            ['Signboard', 'সাইনবোর্ড', 'marketing'],
            ['Photography', 'ফটোগ্রাফি', 'marketing'],
            ['Software Subscription', 'সফটওয়্যার ফি', 'marketing'],
            ['POS Paper Roll', 'পস পেপার রোল', 'marketing'],
            ['Bank Charge', 'ব্যাংক চার্জ', 'marketing'],
            ['Miscellaneous', 'অন্যান্য', 'marketing'],
        ];

        foreach ($items as $item) {
            ExpenseItem::create([
                'name_en' => $item[0],
                'name_bn' => $item[1],
                'slug' => Str::slug($item[0]),
                'category' => $item[2],
            ]);
        } 
    }
}


