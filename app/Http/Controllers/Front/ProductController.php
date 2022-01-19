<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show(Product $product)
    {   
        $detailsProduct = $product->load(['subcategory.category:id,name','attributes:name']);
        return view('front.products.detail', compact('detailsProduct'));
    }
}
