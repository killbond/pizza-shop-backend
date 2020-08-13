<?php

use Illuminate\Database\Seeder;
use Laravel\Passport\ClientRepository;

class OauthClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param  ClientRepository  $clientRepository
     * @return void
     */
    public function run(ClientRepository $clientRepository)
    {
        $clientRepository->createPersonalAccessClient(1, 'Personal Access Token', '/');
    }
}
