<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\{Slider, Product, Category, Blog};
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $currentDate = Carbon::now()->format('Y-m-d');
        $threeMonthAgo = Carbon::now()->subMonths(3)->format('Y-m-d');

        $sliders = Slider::with('product:id,name,slug')
            ->latest()->take(4)->get();

        $products = Product::latest()->get([
            'name','slug','price','discount','image_list'])
            ->take(12);
        
        $featuredProducts = Product::select([
            'name','slug','price','discount','image_list'])
            ->withSum(['orders' => function ($query) use ($currentDate, $threeMonthAgo) {
                $query->whereBetween('orders.created_at', [$threeMonthAgo, $currentDate]);               
            }],'order_details.quantity')
            ->orderByDesc('orders_sum_order_detailsquantity')
            ->take(12)
            ->get();

        $blogs = Blog::with('user:id,name')->latest()->get([
            'slug','title','user_id','created_at','description','cover_image'])
            ->take(3);

        return view('front.home', compact('sliders','products','featuredProducts','blogs'));
    }
}
