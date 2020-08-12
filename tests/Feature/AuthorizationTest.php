<?php

namespace Tests\Feature;

use Illuminate\Http\Response;
use Tests\TestCase;

class AuthorizationTest extends TestCase
{
    public function testSuccessLogin()
    {
        $credentials = ['username' => 'test@pizza-shop.com', 'password' => '123456'];
        $response = $this->postJson('api/v1/auth/login', $credentials);
        $response->assertStatus(200);
        $token = $response->json('data.access_token');
        $this->assertNotEmpty($token);
        $this->assertAuthenticated();
    }

    public function testFailedLogin()
    {
        $credentials = ['username' => 'invalid_email', 'password' => '123456'];
        $response = $this->postJson('api/v1/auth/login', $credentials);
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
        $token = $response->json('data.access_token');
        $this->assertEmpty($token);
        $this->assertGuest();
    }
}
