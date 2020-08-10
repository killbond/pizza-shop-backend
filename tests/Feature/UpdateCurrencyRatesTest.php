<?php

namespace Tests\Feature;

use App\Currency;
use CurrenciesTableSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateCurrencyRatesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRatesUpdated()
    {
        $this->seed(CurrenciesTableSeeder::class);

        $this->artisan('currency:update-rates')
            ->assertExitCode(0);

        $eurToUsd = Currency::whereCode('eur')->first();

        $this->assertNotEquals(null, $eurToUsd);
        $this->assertNotEquals(1, $eurToUsd->usd_rate);
        $this->assertNotEquals(null, $eurToUsd->updated_at);
    }
}
