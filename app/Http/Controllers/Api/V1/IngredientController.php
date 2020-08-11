<?php

namespace App\Http\Controllers\Api\V1;

use App\Ingredient;
use App\Http\Controllers\Controller;
use App\Http\Resources\IngredientResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Class IngredientController
 * @package App\Http\Controllers\Api\V1
 */
class IngredientController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function __invoke()
    {
        return IngredientResource::collection(Ingredient::all());
    }
}
