<?php

namespace Tests\Feature;

use App\Ingredient;
use Tests\TestCase;

class IngredientResourceTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testFetchingIngredients()
    {
        $response = $this->get('api/v1/ingredients');
        $response->assertStatus(200);
        $ingredients = collect($response->json('data.*.name'));
        $intersect = $ingredients->intersect(['Mozzarella', 'Ham']);
        $this->assertTrue($intersect->isNotEmpty());
    }

    public function testIngredientCreation()
    {
        $ingredient = Ingredient::create(['name' => 'Test']);
        $this->assertDatabaseHas('ingredients', $ingredient->toArray());
    }
}
