<?php

namespace Tests\Feature;

use CurrenciesTableSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CurrencyResourceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testFetchingCurrencyRates()
    {
        $this->seed(CurrenciesTableSeeder::class);
        $response = $this->get('api/v1/currencies');
        $response->assertStatus(200)
            ->assertJsonPath('data.*.code', ['USD', 'EUR']);
    }
}
