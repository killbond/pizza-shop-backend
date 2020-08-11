<?php

use Illuminate\Database\Seeder;

class IngredientProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ingredientProducts = [
            ['product_id' => 1, 'ingredient_id' => 1],
            ['product_id' => 1, 'ingredient_id' => 2],
            ['product_id' => 1, 'ingredient_id' => 3],
            ['product_id' => 2, 'ingredient_id' => 1],
            ['product_id' => 2, 'ingredient_id' => 4],
            ['product_id' => 3, 'ingredient_id' => 1],
            ['product_id' => 3, 'ingredient_id' => 4],
            ['product_id' => 3, 'ingredient_id' => 6],
            ['product_id' => 3, 'ingredient_id' => 7],
            ['product_id' => 4, 'ingredient_id' => 1],
            ['product_id' => 4, 'ingredient_id' => 9],
            ['product_id' => 4, 'ingredient_id' => 8],
            ['product_id' => 4, 'ingredient_id' => 6],
            ['product_id' => 5, 'ingredient_id' => 1],
            ['product_id' => 5, 'ingredient_id' => 2],
            ['product_id' => 5, 'ingredient_id' => 3],
            ['product_id' => 5, 'ingredient_id' => 11],
            ['product_id' => 6, 'ingredient_id' => 1],
            ['product_id' => 6, 'ingredient_id' => 3],
            ['product_id' => 6, 'ingredient_id' => 10],
            ['product_id' => 7, 'ingredient_id' => 1],
            ['product_id' => 7, 'ingredient_id' => 10],
            ['product_id' => 8, 'ingredient_id' => 1],
            ['product_id' => 8, 'ingredient_id' => 2],
            ['product_id' => 8, 'ingredient_id' => 3],
            ['product_id' => 8, 'ingredient_id' => 5],
        ];

        foreach ($ingredientProducts as $ingredientProduct) {
            DB::table('ingredient_product')
                ->insert($ingredientProduct);
        }
    }
}
