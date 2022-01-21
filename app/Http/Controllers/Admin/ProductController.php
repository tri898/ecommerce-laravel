<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Category, Attribute, Product};
use App\Http\Requests\ProductRequest;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DataTables;

class ProductController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		if($request->ajax()) {
			$products = Product::with('subcategory:id,name')->latest()
				->get(['id','name','subcategory_id','price','discount','is_in_stock']);

			return DataTables::of($products)
				->addIndexColumn()
				->addColumn('actions', function($row) {
					return '<a href="/admin/products/'.$row['id'].'/edit" class="btn btn-warning">
							<i class="lnr lnr-pencil"></i></a>
							<a href="javascript:void(0)" onclick="onDelete(event.currentTarget)"
							 data-id="'.$row['id'].'" class="btn btn-danger">
							 <i class="lnr lnr-trash"></i></a>
							<a href="javascript:void(0)" onclick="onShow(event.currentTarget)"
							 data-id="'.$row['id'].'" class="btn btn-success">
							 <i class="lnr lnr-eye"></i></a>';
				})
				->rawColumns(['actions'])
				->make(true);
		}
		return view('admin.products.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$categories = Category::with('subcategories:id,name,category_id')
			->get(['id','name']);

		$attributes = Attribute::get(['id','name']);
		$attrArray = $this->convertCollectionToArray($attributes);

		return view('admin.products.create',compact(
			'categories','attrArray'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(ProductRequest $request)
	{
		$fields = $request->validated();
		
		$productInput = $request->safe()->except(['prod_images','attributes']);
		$productInput['slug'] = Str::slug($fields['name']);

		if($request->hasfile('prod_images')) {
		    $productInput['image_list'] = json_encode(
				Helper::uploadImage($fields['prod_images']));
		}

		$product = Product::create($productInput);
		
		if($request->has('attributes')){
			$prodAttr = $this->formatArrayToJson($fields['attributes']);
			$product->attributes()->attach($prodAttr);
		}
		return redirect()->route('admin.products.index')->with(
			'status', 'Product created successfully!');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show(Product $product)
	{
		$product->load('subcategory:id,name');

		return response()->json($product);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Product $product)
	{
		$categories = Category::with('subcategories:id,name,category_id')
			->get(['id','name']);

		$attributes = Attribute::get(['id','name']);
		$attrArray = $this->convertCollectionToArray($attributes);

		$productAttributes = $product->attributes()
			->get(['attributes.id','attributes.name']);

		$prodAttributeArray = $this->formatJsonToArray($productAttributes);

		return view('admin.products.edit', compact(
			'product','categories','attrArray','prodAttributeArray'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(ProductRequest $request, Product $product)
	{	
		$fields = $request->validated();
		
		$productInput = $request->safe()->except([
			'prod_images','old_prod_images','attributes']);
		$productInput['slug'] = Str::slug($fields['name']);

		if($request->hasfile('prod_images')) {
			Helper::deleteImage(json_decode($fields['old_prod_images']));

			$productInput['image_list'] = json_encode(
				Helper::uploadImage($fields['prod_images']));
		}
		$product->update($productInput);
		
		if($request->has('attributes')){
			$prodAttr = $this->formatArrayToJson($fields['attributes']);
			$product->attributes()->sync($prodAttr);	
		}
		else {
			$product->attributes()->detach();
		}

		return redirect()->route('admin.products.index')->with(
			'status', 'Product updated successfully!');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Product $product)
	{
		Helper::deleteImage(json_decode($product->image_list));
		$product->delete();

		return response()->json([
			'message' => 'Deleted product successfully'],200);
	}
	/**
	 * Convert collection (id-name) to associative array.
	 *
	 * @param Collection $inputs
	 * @return Associative Array
	 */
	public function convertCollectionToArray($inputs)
	{
		$result = [];
		foreach($inputs as $input) {
			$result[$input->id] = $input->name; 
		}
		return $result;
	}
	/**
	 * Format array to json array.
	 *
	 * @param  arr $array
	 * @return array
	 */
	public function formatArrayToJson($array)
	{
		$result = [];
		foreach($array as $key => $item) {
			$values = explode(',',$item);
			$result[$key] = ['value' => json_encode($values)];
		}
		return $result;
	}
	/**
	 * Format collection to array string.
	 *
	 * @param  arr $array
	 * @return array
	 */
	public function formatJsonToArray($items) {
		$result= [];
		foreach($items as $item) {
			//decode json here
			$values = json_decode($item->pivot->value);
			// then parse arr to string
			$result[$item->id] = implode(',',$values);
		}
		return $result;

	}
	public function getProducts()
	{
		$products = Product::get(['id','name']);   
        return response()->json($products);
	}
	
}