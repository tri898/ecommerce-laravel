<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\{ Slider, Product, Category, Blog};
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::with('product:id,name,slug')
            ->latest()->take(4)->get();

        $products = Product::get(['name', 'slug',
            'price', 'discount', 'image_list'])
            ->take(12);

        $blogs = Blog::with('user:id,name')->latest()
		    ->get(['slug','title','user_id',
            'created_at','description', 'cover_image'])
            ->take(3);

        return view('front.home', compact('sliders', 'products', 'blogs'));
    }
}
