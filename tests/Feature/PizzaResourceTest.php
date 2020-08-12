<?php

namespace Tests\Feature;

use App\Category;
use App\Product;
use Exception;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class PizzaResourceTest extends TestCase
{
    private function fetchResource()
    {
        $response = $this->get('api/v1/pizzas');
        return $response->assertStatus(200);
    }

    public function testFetchingPizzas()
    {
        $response = $this->fetchResource();
        $pizzas = collect($response->json('data.*'));
        $this->assertTrue($pizzas->contains('name', 'Classic pizza'));
        $this->assertTrue($pizzas->contains('name', 'Pepperoni pizza'));
    }

    public function testFetchingPizzaRelations()
    {
        $queriesCount = 0;
        DB::listen(function () use (&$queriesCount) {
            $queriesCount++;
        });

        $response = $this->fetchResource();
        $pizzas = collect($response->json('data.*'));
        $this->assertTrue($pizzas->contains('category.name', 'Pizza'));

        $ingredients = $pizzas->pluck('ingredients')->flatten(1);
        $this->assertTrue($ingredients->contains('name', 'Mozzarella'));
        $this->assertTrue($ingredients->contains('name', 'Ham'));

        $this->assertTrue($pizzas->contains('image.url', '!=', null));

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
