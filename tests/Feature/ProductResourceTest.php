<?php

namespace Tests\Feature;

use App\Category;
use App\Product;
use CategoriesTableSeeder;
use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use IngredientProductTableSeeder;
use IngredientTableSeeder;
use ProductTableSeeder;
use Tests\TestCase;

class ProductResourceTest extends TestCase
{
    use RefreshDatabase;

    public function testFetchingProducts()
    {
        $this->seeds();
        $response = $this->fetchResource();
        $products = collect($response->json('data.*.name'));
        $intersect = $products->intersect(['Classic pizza', 'Pepperoni pizza']);
        $this->assertTrue($intersect->isNotEmpty());
    }

    public function testFetchingProductRelations()
    {
        $this->seeds();
        $response = $this->fetchResource();
        $categories = collect($response->json('data.*.category.name'));
        $this->assertTrue($categories->contains('Pizza'));

        $productIngredients = $response->json('data.*.ingredients.*.name');
        $intersect = $productIngredients->intersect(['Mozarella', 'Ham']);
        $this->assertTrue($intersect->isNotEmpty());
    }

    public function testReferentialIntegrity()
    {
        $this->seeds();
        $product = Product::firstWhere('category_id', 1);
        try {
            Category::find(1)->delete();
        } catch (Exception $e) {
            $this->throwException($e);
        }
        $this->assertDeleted($product);
    }

    private function fetchResource()
    {
        $response = $this->get('api/v1/products');
        $response->assertStatus(200);
        return $response;
    }

    private function seeds()
    {
        $this->seed(CategoriesTableSeeder::class);
        $this->seed(IngredientTableSeeder::class);
        $this->seed(ProductTableSeeder::class);
        $this->seed(IngredientProductTableSeeder::class);
    }
}
