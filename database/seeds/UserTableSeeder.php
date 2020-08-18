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
        $users = [
            [
                'name' => 'test',
                'email' => 'test@pizza-shop.com',
                'phone' => '+491771789427',
                'password' => Hash::make('123456'),
            ],
            [
                'name' => 'test2',
                'email' => 'test2@pizza-shop.com',
                'phone' => '+491671789427',
                'password' => Hash::make('123456'),
            ],
        ];

        foreach ($users as $user) {
            DB::table('users')
                ->insert($user);
        }
    }
}
