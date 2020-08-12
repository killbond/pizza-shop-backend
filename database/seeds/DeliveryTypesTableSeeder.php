<?php

use Illuminate\Database\Seeder;

class DeliveryTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            'delivery',
            'takeaway',
        ];

        foreach ($types as $type) {
            DB::table('delivery_types')
                ->insert(['name' => $type]);
        }
    }
}
