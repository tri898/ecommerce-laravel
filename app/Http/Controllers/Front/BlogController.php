<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        $blogs = Blog::select(['slug','title','user_id',
            'created_at','description', 'cover_image'])
            ->with('user:id,name')->latest()
            ->paginate(4);

        $randomProduct = $this->productRepository
            ->getRandomProduct();
        
        return view('front.blogs.index', compact(
            'blogs','randomProduct'));
    }
    public function show(Blog $blog)
    {
        $randomProduct = $this->productRepository->getRandomProduct();

        return view('front.blogs.detail', compact(
            'blog','randomProduct'));
    }
}
