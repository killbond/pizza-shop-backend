<?php

namespace App\Console\Commands;

use Exception;
use App\Currency;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class UpdateCurrencyRates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currency:update-rates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update currency rates';

    /**
     * External api endpoint
     *
     * @var string
     */
    protected $endpoint = 'https://api.exchangeratesapi.io/latest';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $currencies = Currency::all();
        $rates = $this->getRatesFromAPI();
        foreach ($this->getUpdated($currencies, $rates) as $code => $rate) {
            $currencies->firstWhere('code', $code)
                ->update(['usd_rate' => $rate]);
        }
        $this->info('Currency rates successful updated');
    }

    /**
     * @param  Collection|Currency[]  $currencies
     * @param  Collection  $rates
     * @return Collection
     */
    private function getUpdated(Collection $currencies, Collection $rates)
    {
        return $rates->intersectByKeys($currencies->keyBy('code'));
    }

    /**
     * @return Collection
     */
    private function getRatesFromAPI()
    {
        try {
            $response = Http::get($this->endpoint, ['base' => 'USD']);
            $data = $response->json();
            return collect($data['rates']);
        } catch (Exception $e) {
            $this->error('Error during retrieving rates from API');
        }
        return collect();
    }

}
