<?php

namespace Tests\Feature;

use App\Category;
use App\Product;
use DB;
use Exception;
use Tests\TestCase;

class ProductResourceTest extends TestCase
{
    public function testFetchingProducts()
    {
        $response = $this->fetchResource();
        $products = collect($response->json('data.*'));
        $this->assertTrue($products->contains('name', 'Classic pizza'));
        $this->assertTrue($products->contains('name', 'Pepperoni pizza'));
    }

    private function fetchResource()
    {
        $response = $this->get('api/v1/products');
        return $response->assertStatus(200);
    }

    public function testFetchingProductRelations()
    {
        $queriesCount = 0;
        DB::listen(function () use (&$queriesCount) {
            $queriesCount++;
        });

        $response = $this->fetchResource();
        $categories = collect($response->json('data.*.category'));
        $this->assertTrue($categories->contains('name', 'Pizza'));

        $productIngredients = collect($response->json('data.*.ingredients.*'));
        $this->assertTrue($productIngredients->contains('name', 'Mozzarella'));
        $this->assertTrue($productIngredients->contains('name', 'Ham'));

        $images = collect($response->json('data.*.image.url'));
        $urls = $images->filter(function ($url) {
            return !is_null($url);
        });
        $this->assertTrue($urls->isNotEmpty());

        $this->assertEquals(4, $queriesCount);
    }

    public function testReferentialIntegrity()
    {
        $product = Product::firstWhere('category_id', 1);
        try {
            Category::find(1)->delete();
        } catch (Exception $e) {
            $this->throwException($e);
        }
        $this->assertDeleted($product);
    }
}
