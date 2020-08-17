<?php

namespace Tests\Feature;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
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

    public function testSuccessLogout()
    {
        $credentials = ['email' => 'test@pizza-shop.com', 'password' => '123456'];
        $token = $this->postJson('api/v1/auth/login', $credentials)->json('data.access_token');
        $before = DB::table('oauth_access_tokens')->where('revoked', false)->count('id');
        $response = $this->deleteJson('api/v1/auth/login', [], ['Authorization' => 'Bearer '.$token]);
        $after = DB::table('oauth_access_tokens')->where('revoked', false)->count('id');
        $response->assertStatus(Response::HTTP_NO_CONTENT);
        $this->assertGreaterThan($after, $before);
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
