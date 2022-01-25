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
            'subcategory.category:id,name,slug','attributes:name']);

        $relatedProducts = $product->FindBySubcategoryId(
            $product->subcategory_id)->get([
            'name','slug','price','discount','image_list'])
            ->take(8);

        return view('front.products.detail', compact(
            'productDetails','relatedProducts'));
    }
    
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
}
