<?php

namespace Tests\Feature;

use App\Category;
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

    public function testCategoryCreation()
    {
        $category = Category::create(['name' => 'Test']);
        $this->assertDatabaseHas('categories', $category->toArray());
    }
}
