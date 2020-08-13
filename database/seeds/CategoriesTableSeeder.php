<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Pizza',
            'Drinks',
            'Souses',
        ];

        foreach ($categories as $category) {
            DB::table('categories')
                ->insert(['name' => $category]);
        }
    }
}
