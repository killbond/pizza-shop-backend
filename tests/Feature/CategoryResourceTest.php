<?php

namespace Tests\Feature;

use App\Category;
use Tests\TestCase;

class CategoryResourceTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testFetchingCategories()
    {
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
