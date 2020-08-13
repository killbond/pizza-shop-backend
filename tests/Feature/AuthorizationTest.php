<?php

namespace Tests\Feature;

use Illuminate\Http\Response;
use Tests\TestCase;

class AuthorizationTest extends TestCase
{
    public function testSuccessLogin()
    {
        $credentials = ['email' => 'test@pizza-shop.com', 'password' => '123456'];
        $response = $this->postJson('api/v1/auth/login', $credentials);
        $response->assertStatus(Response::HTTP_OK);
        $token = $response->json('data.access_token');
        $this->assertNotEmpty($token);
        $this->assertAuthenticated();
    }

    public function testFailedLogin()
    {
        $credentials = ['email' => 'test@pizza-shop.com', 'password' => '654321'];
        $response = $this->postJson('api/v1/auth/login', $credentials);
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
        $this->assertNotEmpty($response->json('message'));
        $this->assertGuest();
    }
}
