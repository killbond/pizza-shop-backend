<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Repositories\ProductRepository;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PizzaController extends Controller
{
    /**
     * @param  ProductRepository  $repository
     * @return AnonymousResourceCollection
     */
    public function __invoke(ProductRepository $repository)
    {
        $pizzas = $repository->getPizzas();
        return ProductResource::collection($pizzas);
    }
}
