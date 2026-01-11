<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            // Electronics (Category 1)
            [
                'name' => 'iPhone 15 Pro',
                'category_id' => 1,
                'price' => 1299.99,
                'stock' => 45,
                'status' => 'active',
                'description' => 'Latest iPhone with titanium design and A17 Pro chip'
            ],
            [
                'name' => 'Samsung Galaxy S24 Ultra',
                'category_id' => 1,
                'price' => 1199.99,
                'stock' => 38,
                'status' => 'active',
                'description' => 'Flagship Android phone with S Pen and advanced AI features'
            ],
            [
                'name' => 'MacBook Pro 16" M3 Max',
                'category_id' => 1,
                'price' => 3499.99,
                'stock' => 22,
                'status' => 'active',
                'description' => 'Professional laptop for creators and developers'
            ],
            [
                'name' => 'Sony WH-1000XM5',
                'category_id' => 1,
                'price' => 399.99,
                'stock' => 67,
                'status' => 'active',
                'description' => 'Industry-leading noise cancelling headphones'
            ],
            [
                'name' => 'iPad Air M2',
                'category_id' => 1,
                'price' => 799.99,
                'stock' => 51,
                'status' => 'active',
                'description' => 'Powerful tablet for work and entertainment'
            ],
            [
                'name' => 'PlayStation 5',
                'category_id' => 1,
                'price' => 499.99,
                'stock' => 15,
                'status' => 'active',
                'description' => 'Next-gen gaming console with ultra-high speed SSD'
            ],
            [
                'name' => 'Apple Watch Series 9',
                'category_id' => 1,
                'price' => 429.99,
                'stock' => 89,
                'status' => 'active',
                'description' => 'Advanced smartwatch with health monitoring features'
            ],
            [
                'name' => 'Dyson V15 Detect',
                'category_id' => 1,
                'price' => 749.99,
                'stock' => 32,
                'status' => 'active',
                'description' => 'Cordless vacuum with laser dust detection'
            ],
            [
                'name' => 'Nintendo Switch OLED',
                'category_id' => 1,
                'price' => 349.99,
                'stock' => 27,
                'status' => 'active',
                'description' => 'Hybrid gaming console with vibrant OLED screen'
            ],
            [
                'name' => 'Bose QuietComfort Ultra',
                'category_id' => 1,
                'price' => 429.99,
                'stock' => 43,
                'status' => 'active',
                'description' => 'Premium headphones with immersive audio technology'
            ],

            // Clothing (Category 2)
            [
                'name' => 'Levi\'s 501 Original Jeans',
                'category_id' => 2,
                'price' => 89.99,
                'stock' => 124,
                'status' => 'active',
                'description' => 'Classic straight fit jeans, 100% cotton'
            ],
            [
                'name' => 'Nike Air Force 1',
                'category_id' => 2,
                'price' => 110.00,
                'stock' => 78,
                'status' => 'active',
                'description' => 'Iconic basketball sneakers in white leather'
            ],
            [
                'name' => 'Patagonia Better Sweater',
                'category_id' => 2,
                'price' => 139.00,
                'stock' => 56,
                'status' => 'active',
                'description' => 'Fleece jacket made from recycled materials'
            ],
            [
                'name' => 'Ralph Lauren Polo Shirt',
                'category_id' => 2,
                'price' => 125.00,
                'stock' => 92,
                'status' => 'active',
                'description' => 'Classic cotton pique polo shirt with logo'
            ],
            [
                'name' => 'Adidas Ultraboost 23',
                'category_id' => 2,
                'price' => 190.00,
                'stock' => 34,
                'status' => 'active',
                'description' => 'Running shoes with responsive cushioning'
            ],
            [
                'name' => 'Canada Goose Expedition Parka',
                'category_id' => 2,
                'price' => 1495.00,
                'stock' => 8,
                'status' => 'active',
                'description' => 'Arctic-grade down parka for extreme cold'
            ],
            [
                'name' => 'Lululemon ABC Pants',
                'category_id' => 2,
                'price' => 128.00,
                'stock' => 67,
                'status' => 'active',
                'description' => 'Versatile pants for work and casual wear'
            ],
            [
                'name' => 'The North Face Nuptse Jacket',
                'category_id' => 2,
                'price' => 299.00,
                'stock' => 41,
                'status' => 'active',
                'description' => 'Iconic puffer jacket with 700-fill down'
            ],
            [
                'name' => 'Converse Chuck Taylor All Star',
                'category_id' => 2,
                'price' => 65.00,
                'stock' => 156,
                'status' => 'active',
                'description' => 'Classic canvas sneakers'
            ],
            [
                'name' => 'Uniqlo Ultra Light Down Jacket',
                'category_id' => 2,
                'price' => 69.90,
                'stock' => 203,
                'status' => 'active',
                'description' => 'Packable down jacket for everyday wear'
            ],

            // Books (Category 3)
            [
                'name' => 'The Alchemist',
                'category_id' => 3,
                'price' => 16.99,
                'stock' => 234,
                'status' => 'active',
                'description' => 'Paulo Coelho\'s inspirational novel about following dreams'
            ],
            [
                'name' => 'Atomic Habits',
                'category_id' => 3,
                'price' => 27.00,
                'stock' => 189,
                'status' => 'active',
                'description' => 'James Clear\'s guide to building good habits'
            ],
            [
                'name' => 'Fourth Wing',
                'category_id' => 3,
                'price' => 29.99,
                'stock' => 56,
                'status' => 'active',
                'description' => 'Fantasy novel about dragon riders'
            ],
            [
                'name' => 'It Ends With Us',
                'category_id' => 3,
                'price' => 18.99,
                'stock' => 142,
                'status' => 'active',
                'description' => 'Colleen Hoover\'s bestselling romance novel'
            ],
            [
                'name' => 'The Silent Patient',
                'category_id' => 3,
                'price' => 16.99,
                'stock' => 98,
                'status' => 'active',
                'description' => 'Psychological thriller mystery novel'
            ],
            [
                'name' => 'A Court of Thorns and Roses',
                'category_id' => 3,
                'price' => 19.99,
                'stock' => 76,
                'status' => 'active',
                'description' => 'Fantasy romance novel by Sarah J. Maas'
            ],
            [
                'name' => 'Lessons in Chemistry',
                'category_id' => 3,
                'price' => 29.00,
                'stock' => 89,
                'status' => 'active',
                'description' => 'Novel about a female scientist in the 1960s'
            ],
            [
                'name' => 'The Woman in Me',
                'category_id' => 3,
                'price' => 32.99,
                'stock' => 63,
                'status' => 'active',
                'description' => 'Britney Spears\' memoir'
            ],
            [
                'name' => 'Iron Flame',
                'category_id' => 3,
                'price' => 32.99,
                'stock' => 45,
                'status' => 'active',
                'description' => 'Sequel to Fourth Wing'
            ],
            [
                'name' => 'Holly',
                'category_id' => 3,
                'price' => 30.00,
                'stock' => 71,
                'status' => 'active',
                'description' => 'Stephen King\'s latest thriller'
            ],

            // Home & Kitchen (Category 4)
            [
                'name' => 'Instant Pot Duo 7-in-1',
                'category_id' => 4,
                'price' => 99.95,
                'stock' => 56,
                'status' => 'active',
                'description' => 'Electric pressure cooker with multiple functions'
            ],
            [
                'name' => 'Vitamix 5200 Blender',
                'category_id' => 4,
                'price' => 449.95,
                'stock' => 23,
                'status' => 'active',
                'description' => 'Professional-grade blender for smoothies and soups'
            ],
            [
                'name' => 'All-Clad Stainless Steel Cookware Set',
                'category_id' => 4,
                'price' => 899.99,
                'stock' => 12,
                'status' => 'active',
                'description' => '10-piece professional cookware set'
            ],
            [
                'name' => 'Le Creuset Dutch Oven',
                'category_id' => 4,
                'price' => 379.99,
                'stock' => 18,
                'status' => 'active',
                'description' => '5.5-quart enameled cast iron Dutch oven'
            ],
            [
                'name' => 'Ninja Foodi 14-in-1',
                'category_id' => 4,
                'price' => 299.99,
                'stock' => 34,
                'status' => 'active',
                'description' => 'Pressure cooker and air fryer combo'
            ],
            [
                'name' => 'Breville Barista Express',
                'category_id' => 4,
                'price' => 699.95,
                'stock' => 16,
                'status' => 'active',
                'description' => 'Espresso machine with built-in grinder'
            ],
            [
                'name' => 'Zwilling J.A. Henckels Knife Set',
                'category_id' => 4,
                'price' => 299.99,
                'stock' => 29,
                'status' => 'active',
                'description' => '15-piece professional knife block set'
            ],
            [
                'name' => 'Cuisinart Food Processor',
                'category_id' => 4,
                'price' => 199.99,
                'stock' => 42,
                'status' => 'active',
                'description' => '14-cup capacity food processor'
            ],
            [
                'name' => 'KitchenAid Stand Mixer',
                'category_id' => 4,
                'price' => 429.99,
                'stock' => 21,
                'status' => 'active',
                'description' => 'Professional 5-quart stand mixer'
            ],
            [
                'name' => 'OXO Good Grips Utensil Set',
                'category_id' => 4,
                'price' => 49.99,
                'stock' => 87,
                'status' => 'active',
                'description' => 'Ergonomic kitchen utensil set'
            ],

            // Beauty & Personal Care (Category 5)
            [
                'name' => 'Dyson Airwrap',
                'category_id' => 5,
                'price' => 599.99,
                'stock' => 28,
                'status' => 'active',
                'description' => 'Hair styling tool with air technology'
            ],
            [
                'name' => 'La Mer Moisturizing Cream',
                'category_id' => 5,
                'price' => 385.00,
                'stock' => 45,
                'status' => 'active',
                'description' => 'Luxury facial moisturizer'
            ],
            [
                'name' => 'Shark FlexStyle',
                'category_id' => 5,
                'price' => 299.99,
                'stock' => 37,
                'status' => 'active',
                'description' => '5-in-1 hair styling tool'
            ],
            [
                'name' => 'Sunday Riley Good Genes',
                'category_id' => 5,
                'price' => 122.00,
                'stock' => 63,
                'status' => 'active',
                'description' => 'Exfoliating treatment serum'
            ],
            [
                'name' => 'Drunk Elephant Protini Polypeptide Cream',
                'category_id' => 5,
                'price' => 68.00,
                'stock' => 79,
                'status' => 'active',
                'description' => 'Signal peptide facial moisturizer'
            ],
            [
                'name' => 'Charlotte Tilbury Pillow Talk Lipstick',
                'category_id' => 5,
                'price' => 35.00,
                'stock' => 142,
                'status' => 'active',
                'description' => 'Iconic matte lipstick in rose pink'
            ],
            [
                'name' => 'Sol de Janeiro Brazilian Bum Bum Cream',
                'category_id' => 5,
                'price' => 48.00,
                'stock' => 96,
                'status' => 'active',
                'description' => 'Cult-favorite body cream with cupuaçu butter'
            ],
            [
                'name' => 'The Ordinary Niacinamide 10% + Zinc 1%',
                'category_id' => 5,
                'price' => 6.80,
                'stock' => 287,
                'status' => 'active',
                'description' => 'Oil control and blemish serum'
            ],
            [
                'name' => 'Olaplex No. 3 Hair Perfector',
                'category_id' => 5,
                'price' => 30.00,
                'stock' => 134,
                'status' => 'active',
                'description' => 'At-home hair repair treatment'
            ],
            [
                'name' => 'Fenty Beauty Pro Filt\'r Soft Matte Foundation',
                'category_id' => 5,
                'price' => 39.00,
                'stock' => 89,
                'status' => 'active',
                'description' => 'Longwear foundation with 50 shades'
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}