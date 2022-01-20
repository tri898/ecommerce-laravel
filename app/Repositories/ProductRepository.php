<?php

namespace App\Repositories;
use App\Models\Product;

class ProductRepository
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }
    public function getRandomProduct()
    {
        return $this->product->inRandomOrder()->get(['name','slug',
            'price', 'discount','image_list'])
            ->take(4);
    }
}