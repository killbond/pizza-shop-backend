<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $codes = [
            'usd',
            'eur',
        ];

        foreach ($codes as $code) {
            DB::table('currencies')
                ->insert(['code' => $code]);
        }
    }
}
