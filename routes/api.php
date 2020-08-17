<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1'], function () {
    Route::get('currencies', 'Api\V1\CurrencyController');
    Route::get('categories', 'Api\V1\CategoryController');
    Route::get('ingredients', 'Api\V1\IngredientController');
    Route::get('products', 'Api\V1\ProductController');
    Route::get('pizzas', 'Api\V1\PizzaController');
    Route::post('users', 'Api\V1\UserController');
    Route::get('users/{user}/orders', 'Api\V1\OrderController@list')->middleware('auth:api');
    Route::post('auth/login', 'Api\V1\AuthController@login');
    Route::delete('auth/login', 'Api\V1\AuthController@logout');
    Route::post('orders', 'Api\V1\OrderController@store');
});
