<?php

namespace Tests\Feature;

use App\Order;
use App\User;
use Illuminate\Http\Response;
use Tests\TestCase;

class OrderResourceTest extends TestCase
{
    public function testSuccessStoreOrder()
    {
        $data = [
            'currency_id' => 1,
            'phone' => '+491771789427',
            'positions' => [
                ['product_id' => 1, 'quantity' => 1],
                ['product_id' => 2, 'quantity' => 2],
            ],
        ];
        $response = $this->postJson('api/v1/orders', $data);
        $response->assertStatus(Response::HTTP_OK);
        $this->assertDatabaseHas('orders', ['phone' => '+491771789427']);
    }

    public function testFailedStoreOrder()
    {
        $data = ['currency_id' => 1, 'phone' => '+491771789427'];
        $response = $this->postJson('api/v1/orders', $data);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $this->assertDatabaseMissing('orders', ['phone' => '+491771789427']);
    }

    public function testAuthentication()
    {
        $response = $this->getJson('api/v1/users/1/orders');
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    public function testFetchingUserOrders()
    {
        factory(Order::class, 10)->create();
        $user = User::firstWhere('email', 'test@pizza-shop.com');
        $this->actingAs($user, 'api');
        $response = $this->getJson('api/v1/users/1/orders');
        $response->assertStatus(Response::HTTP_OK);
        $this->assertNotEquals(0, $response->json('data.*.positions'));
    }
}
