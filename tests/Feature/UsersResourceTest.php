<?php

namespace Tests\Feature;

use Illuminate\Http\Response;
use Tests\TestCase;

class UsersResourceTest extends TestCase
{
    public function testSuccessRegistration()
    {
        $response = $this->post('api/v1/users', [
            'name' => 'John Doe',
            'email' => 'john_doe@gmail.com',
            'phone' => '+447868150810',
            'password' => '123456',
            'password_confirm' => '123456',
        ]);
        $response->assertStatus(Response::HTTP_CREATED);
        $this->assertDatabaseHas('users', ['email' => 'john_doe@gmail.com']);
    }

    public function testFailedRegistration()
    {
        $response = $this->post('api/v1/users', [
            'name' => 'John Doe',
            'email' => 'invalid_email',
            'phone' => '+447868150810',
            'password' => '123456',
            'password_confirm' => '1234567',
        ]);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $this->assertDatabaseMissing('users', ['email' => 'john_doe@gmail.com']);
    }
}
