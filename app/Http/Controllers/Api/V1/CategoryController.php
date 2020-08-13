<?php

namespace App\Http\Controllers\Api\V1;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Class CategoryController
 * @package App\Http\Controllers\Api\V1
 */
class CategoryController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function __invoke()
    {
        return CategoryResource::collection(Category::all());
    }
}
