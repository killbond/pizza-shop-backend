<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\IngredientResource;
use App\Ingredient;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    public function __invoke(Request $request)
    {
        return IngredientResource::collection(Ingredient::all());
    }
}
