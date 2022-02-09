<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewRequest;
use App\Models\{Product, Category, Subcategory};
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
       if ($request->ajax()) {
            $products = Product::select([
                'name','slug','price','discount','image_list'])
				->Sort($request)
				->Price($request)
				->Color($request)
            	->paginate(12);
			$view = view('front.products.list', ['products' => $products])->render();

			return response()->json([
				'data' => $view, 'filter' =>$request->all(), 'url' =>$request->fullUrl()]);
        }
       
        return view('front.products.all');
    }
    
    public function show(Product $product)
    {   
        $productDetails = $product->load([
            'subcategory.category:id,name,slug','attributes:name']);

        $productReviews = $product->reviews()->get();

        $relatedProducts = $product->FindBySubcategoryId(
            $product->subcategory_id)->get([
            'name','slug','price','discount','image_list'])
            ->take(8);

        return view('front.products.detail', compact(
            'productDetails','relatedProducts', 'productReviews'));
    }

    public function review(ReviewRequest $request,Product $product)
    {   
        $fields = $request->validated();
        $fields['name'] = auth()->user()->name;

        $product->reviews()->create($fields);
        
        return back();

    }

    public function cateProduct(Request $request, Category $category)
    {
        if ($request->ajax()) {
            $products = Product::select([
            	'name','slug','price','discount','image_list'])
                ->FindByCategoryId($category->id)
				->Sort($request)
				->Price($request)
				->Color($request)
            	->paginate(12);
			$view = view('front.products.list', ['products' => $products])->render();

			return response()->json([
				'data' => $view, 'filter' =>$request->all(), 'url' =>$request->fullUrl()]);
        }

        return view('front.products.category', compact('category'));
    }

    public function subProduct(Request $request, Category $category, Subcategory $subcategory)
    {
        if ($request->ajax()) {
            $products = Product::select([
                'name','slug','price','discount','image_list'])
                ->FindBySubcategoryId($subcategory->id)
				->Sort($request)
				->Price($request)
				->Color($request)
            	->paginate(12);
			$view = view('front.products.list', ['products' => $products])->render();

			return response()->json([
				'data' => $view, 'filter' =>$request->all(), 'url' =>$request->fullUrl()]);
        }

        return view('front.products.subcategory', compact(
            'category','subcategory'));
    }

    public function search(Request $request)
    {
       $products = Product::select([
                'name','slug','price','discount','image_list'])
                ->Name($request)
            	->paginate(12);
        $query = $request->q;
       
        return view('front.products.search',compact('products','query'));
    }
}
