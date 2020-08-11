<?php

use Illuminate\Database\Seeder;

class IngredientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ingredients = [
            'Mozzarella',
            'Ham',
            'Mushrooms',
            'Pepperoni',
            'Jalapenos',
            'Red onion',
            'Pepper mix',
            'Chicken',
            'Corn',
            'Cherry tomatoes',
            'Pepper mix',
        ];

        foreach ($ingredients as $ingredient) {
            DB::table('ingredients')
                ->insert(['name' => $ingredient]);
        }
    }
}
