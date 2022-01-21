<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\{Blog, Product};
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class BlogController extends Controller
{

    public function index()
    {
        $blogs = Blog::select([
            'slug','title','user_id','created_at','description','cover_image'])
            ->with('user:id,name')->latest()
            ->paginate(4);

        $randomProducts = Product::inRandomOrder()->get([
            'name','slug','price','discount','image_list'])
            ->take(4);
        
        return view('front.blogs.index', compact('blogs','randomProducts'));
    }

    public function show(Blog $blog)
    {
        $randomProducts = Product::inRandomOrder()
            ->get(['name','slug','price','discount','image_list'])
            ->take(4);

        return view('front.blogs.detail', compact('blog','randomProducts'));
    }
}
