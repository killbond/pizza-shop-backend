<?php

use App\Product;
use Illuminate\Database\Seeder;

class ImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $images = [
            [
                'name' => 'classic.webp',
                'imagable_id' => 1,
            ],
            [
                'name' => 'pepperoni.webp',
                'imagable_id' => 2,
            ],
            [
                'name' => 'supreme.webp',
                'imagable_id' => 3,
            ],
            [
                'name' => 'texas.webp',
                'imagable_id' => 4,
            ],
            [
                'name' => 'european.webp',
                'imagable_id' => 5,
            ],
            [
                'name' => 'americana.webp',
                'imagable_id' => 6,
            ],
            [
                'name' => 'margherita.jpg',
                'imagable_id' => 7,
            ],
            [
                'name' => 'hot.webp',
                'imagable_id' => 8,
            ],
        ];

        $type = Product::class;
        foreach ($images as $image) {
            $image['imagable_type'] = $type;
            DB::table('images')
                ->insert($image);
        }
    }
}
