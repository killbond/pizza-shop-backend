<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CurrenciesTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(IngredientTableSeeder::class);
        $this->call(ProductTableSeeder::class);
        $this->call(IngredientProductTableSeeder::class);
    }
}
