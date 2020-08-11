<?php

namespace App\Http\Controllers\Api\V1;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __invoke(Request $request)
    {
        return CategoryResource::collection(Category::all());
    }
}
