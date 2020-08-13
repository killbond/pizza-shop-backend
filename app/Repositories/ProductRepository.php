<?php

namespace App\Repositories;

use App\Product;
use Illuminate\Database\Eloquent\Builder;

class ProductRepository
{
    /**
     * @var Product|Builder
     */
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function getPizzas()
    {
        return $this->product->whereCategoryId(1)
            ->with('ingredients', 'category', 'image')
            ->get();
    }

    public function getProducts()
    {
        return $this->product->with('category', 'image')
            ->where('category_id', '!=', 1)
            ->get();
    }
}
