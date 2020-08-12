<?php

namespace Tests\Feature;

use DB;
use Tests\TestCase;

class ProductResourceTest extends TestCase
{
    private function fetchResource()
    {
        $response = $this->get('api/v1/products');
        return $response->assertStatus(200);
    }

    public function testFetchingProducts()
    {
        $response = $this->fetchResource();
        $products = collect($response->json('data.*'));
        $this->assertFalse($products->contains('name', 'Classic pizza'));
        $this->assertTrue($products->contains('name', 'Water'));
    }

    public function testFetchingProductsRelations()
    {
        $queriesCount = 0;
        DB::listen(function () use (&$queriesCount) {
            $queriesCount++;
        });

        $response = $this->fetchResource();
        $categories = collect($response->json('data.*.category'));
        $this->assertFalse($categories->contains('name', 'Pizza'));

        $products = collect($response->json('data.*'));
        $this->assertFalse($products->contains('ingredients', '!=', null));
        $this->assertTrue($products->contains('image.url', '!=', null));

        $this->assertEquals(3, $queriesCount);
    }
}
