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
            'password_confirmation' => '123456',
        ]);
        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertJsonPath('data.email', 'john_doe@gmail.com');
        $this->assertDatabaseHas('users', ['email' => 'john_doe@gmail.com']);
    }

    public function testFailedRegistration()
    {
        $response = $this->post('api/v1/users', [
            'name' => 'John Doe',
            'email' => 'test@pizza-shop.com',
            'phone' => '+447868150710',
            'password' => '123456',
            'password_confirmation' => '1234567',
        ]);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $this->assertNotEmpty($response->json('messages'));
        $this->assertDatabaseMissing('users', ['phone' => '+447868150710']);
    }
}
