<?php

namespace Tests\Feature;

use Tests\TestCase;

class CurrencyResourceTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testFetchingCurrencyRates()
    {
        $response = $this->get('api/v1/currencies');
        $response->assertStatus(200)
            ->assertJsonPath('data.*.code', ['USD', 'EUR']);
    }
}
