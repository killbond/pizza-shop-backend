<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use IngredientTableSeeder;
use Tests\TestCase;

class IngredientResourceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testFetchingIngredients()
    {
        $this->seed(IngredientTableSeeder::class);
        $response = $this->get('api/v1/ingredients');
        $response->assertStatus(200);
        $ingredients = collect($response->json('data.*.name'));
        $intersect = $ingredients->intersect(['Mozzarella', 'Ham']);
        $this->assertTrue($intersect->isNotEmpty());
    }
}
