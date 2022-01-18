<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\{ Slider, Product, Category, Blog};
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::with('product:id,name')
            ->latest()->get();

        $products = Product::get(['name', 'slug',
            'price', 'discount', 'image_list']);

        $blogs = Blog::with('user:id,name')->latest()
		    ->get(['slug','title','user_id',
            'created_at','description', 'cover_image']);

        return view('front.home', compact('sliders', 'products', 'blogs'));
    }
}
