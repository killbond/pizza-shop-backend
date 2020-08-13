<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            // Pizza
            [
                'category_id' => 1,
                'name' => 'Classic pizza',
                'description' => 'Try boiling smoothie rubed with sour milk, seasoned with pepper.',
                'price' => 5.39,
            ],
            [
                'category_id' => 1,
                'name' => 'Pepperoni pizza',
                'description' => 'Bloody, crusted pudding is best marinated with muddy gravy.',
                'price' => 5.69,
            ],
            [
                'category_id' => 1,
                'name' => 'Supreme pizza',
                'description' => 'Vinaigrette soup is just not the same without chipotle chile powder and smashed al dente rice.',
                'price' => 5.79,
            ],
            [
                'category_id' => 1,
                'name' => 'Texas pizza',
                'description' => 'All children like scraped chicken lards in salad cream and vegemite.',
                'price' => 5.59,
            ],
            [
                'category_id' => 1,
                'name' => 'European pizza',
                'description' => 'All children like scraped chicken lards in salad cream and vegemite.',
                'price' => 5.89,
            ],
            [
                'category_id' => 1,
                'name' => 'Americana pizza',
                'description' => 'After warming the raspberries, toss caviar, white bread and fish sauce with it in a wok.',
                'price' => 6.22,
            ],
            [
                'category_id' => 1,
                'name' => 'Margherita pizza',
                'description' => 'Brush three pounds of ground beef in one quarter cup of water.',
                'price' => 4.99,
            ],
            [
                'category_id' => 1,
                'name' => 'Hot pizza',
                'description' => 'Heat cold rice in a cooker with vinegar for about an hour to upgrade their sourness.',
                'price' => 5.13,
            ],
            // Drinks
            [
                'category_id' => 2,
                'name' => 'Pepsi',
                'description' => 'To the diced chicory add chicken, pork shoulder, salsa verde and shredded rice.',
                'price' => 1.99,
            ],
            [
                'category_id' => 2,
                'name' => 'Cola',
                'description' => 'What’s the secret to sichuan-style and crusted pickles? Always use sour vegemite.',
                'price' => 1.99,
            ],
            [
                'category_id' => 2,
                'name' => 'Sprite',
                'description' => 'Try crushing pie enameled with teriyaki, whisked with garlic.',
                'price' => 1.99,
            ],
            [
                'category_id' => 2,
                'name' => 'Water',
                'description' => 'Sour, small pudding is best brushed with raw maple syrup.',
                'price' => 1.75,
            ],
            // Souses
            [
                'category_id' => 3,
                'name' => 'Garlic sauce',
                'description' => 'Peanut soup is just not the same without rum and hot fresh strudels.',
                'price' => 0.99,
            ],
            [
                'category_id' => 3,
                'name' => 'BBQ sauce',
                'description' => 'All children like chopped marshmellows in water and wasabi.',
                'price' => 0.99,
            ],
            [
                'category_id' => 3,
                'name' => 'Tomato sauce',
                'description' => 'Chocolate tastes best with champaign and lots of anise.',
                'price' => 0.99,
            ],
        ];

        foreach ($products as $product) {
            DB::table('products')
                ->insert($product);
        }
    }
}
