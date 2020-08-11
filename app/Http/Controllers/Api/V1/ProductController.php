<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Product;
use Illuminate\Http\Request;

/**
 * Class ProductController
 * @package App\Http\Controllers\Api\V1
 */
class ProductController extends Controller
{
    public function __invoke(Request $request)
    {
        $products = Product::with('ingredients', 'category')->get();
        return ProductResource::collection($products);
    }
}
