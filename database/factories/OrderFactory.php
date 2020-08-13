<?php

/** @var Factory $factory */

use App\Currency;
use App\Order;
use App\Product;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Order::class, function (Faker $faker) {
    $currencies = Currency::all()->pluck('id');
    return [
        'phone' => $faker->phoneNumber,
        'total' => $faker->randomNumber(2),
        'currency_id' => $faker->randomElement($currencies->toArray())
    ];
});

$factory->afterCreating(Order::class, function (Order $order, Faker $faker) {
    $products = Product::all()->pluck('id');
    $count = $faker->randomElement([1, 2, 3, 4, 5]);

    $positions = [];
    while ($count >= 0) {
        $count--;
        $positions[] = [
            'order_id' => $order->id,
            'product_id' => $faker->randomElement($products->toArray()),
            'quantity' => $faker->randomDigitNotNull
        ];
    }
    DB::table('order_position')->insert($positions);
    if ($faker->boolean) {
        DB::table('order_user')->insert([
            'order_id' => $order->id,
            'user_id' => 1,
        ]);
    }
});
