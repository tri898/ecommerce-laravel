<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\{Product, Category, Subcategory};
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show(Product $product)
    {   
        $productDetails = $product->load([
            'subcategory.category:id,name,slug',
            'attributes:name']);

        $relatedProducts = $product->FindBySubcategoryId(
            $product->subcategory_id)
            ->get(['name','slug','price',
            'discount','image_list'])
            ->take(8);

        return view('front.products.detail', compact(
            'productDetails','relatedProducts'));
    }
    
    public function index()
    {
        $products = Product::get(['name','slug','price',
            'discount','image_list']);
        return view('front.products.all', compact('products'));
    }

    public function cateProduct(Category $category)
    {
        $products = Product::FindByCategoryId($category->id)
            ->get(['id','name','slug','price',
            'discount','image_list']);

        return view('front.products.category', compact(
            'category','products'));
    }

    public function subProduct(Category $category, Subcategory $subcategory)
    {
        $products = Product::FindBySubcategoryId($subcategory->id)
            ->get(['id','name','slug','price',
            'discount','image_list']);

        return view('front.products.subcategory', compact(
            'category','subcategory','products'));
    }
}
