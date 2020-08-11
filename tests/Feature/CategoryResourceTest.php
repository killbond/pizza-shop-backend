<?php

namespace Tests\Feature;

use CategoriesTableSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryResourceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testFetchingCategories()
    {
        $this->seed(CategoriesTableSeeder::class);
        $response = $this->get('api/v1/categories');
        $response->assertStatus(200)
            ->assertJsonPath('data.*.name', ['Pizza', 'Drinks', 'Souses']);
    }
}
