<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')
            ->insert([
                'name' => 'test',
                'email' => 'test@pizza-shop.com',
                'phone' => '+491771789427',
                'password' => Hash::make('123456'),
            ]);
    }
}
