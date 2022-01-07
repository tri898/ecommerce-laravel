<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Category, Attribute, Product};
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DataTables;
use File;

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
			$products = Product::with('subcategory:id,name')->latest()->get();
			return DataTables::of($products)
								->addIndexColumn()
								->addColumn('actions', function($row) {
									return '<a href="/admin/products/'.$row['id'].'/edit" class="btn btn-warning"><i class="lnr lnr-pencil"></i></a>
											<a href="javascript:void(0)" onclick="onDelete(event.currentTarget)"
											 data-id="'.$row['id'].'" class="btn btn-danger"><i class="lnr lnr-trash"></i></a>
											<a href="javascript:void(0)" onclick="onShow(event.currentTarget)"
											 data-id="'.$row['id'].'" class="btn btn-success"><i class="lnr lnr-eye"></i></a>
											 ';
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
		$attrArray = [];
		foreach($attributes as $attribute) {
			$attrArray[$attribute->id] = $attribute->name; 
		}
		return view('admin.products.create',compact('categories','attrArray'));
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
		    $productInput['image_list'] = json_encode($this->uploadImage('prod_images',$request));
		}
		$product = Product::create($productInput);
		
		if($request->has('attributes')){
			foreach($fields['attributes'] as $key => $attrValue) {
				$values = explode(',',$attrValue);
				foreach($values as $value) {
					$prodAttr[] = ['attribute_id'=> $key,'value'=>$value];
				}
			}
			$product->attributeValues()->createMany($prodAttr);
		}
		return redirect()->route('admin.products.index')
		                        ->with('status', 'Product created successfully!');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$product = Product::with('subcategory:id,name')->findOrFail($id);
		
		return response()->json($product);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$product = Product::findOrFail($id);

		$categories = Category::with('subcategories:id,name,category_id')
								->get(['id','name']);

		$attributes = Attribute::get(['id','name']);
		$attrArray = [];
		foreach($attributes as $attribute) {
			$attrArray[$attribute->id] = $attribute->name; 
		}

		$productAttributes = $product->attributeValues()
					->get(['attribute_id','value'])
					->groupBy('attribute_id');
		$prodAttributeArray= [];
		foreach($productAttributes as $key => $productAttribute) {
			$str = '';	
			foreach($productAttribute as $attribute) {
				$str .= $attribute->value . ',';
			}
			$prodAttributeArray[$key] = $str;
		}

		return view('admin.products.edit',
				compact('product','categories','attrArray','prodAttributeArray'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(ProductRequest $request, $id)
	{
		$product = Product::findOrFail($id);
		
		$fields = $request->validated();
		$productInput = $request->safe()->except(['prod_images','old_prod_images','attributes']);
		$productInput['slug'] = Str::slug($fields['name']);

		if($request->hasfile('prod_images')) {
			$this->deleteImage(json_decode($fields['old_prod_images']));
			$productInput['image_list'] = json_encode($this->uploadImage('prod_images',$request));
		}
		$product->update($productInput);
		$product->attributes()->detach();

		if($request->has('attributes')){
			foreach($fields['attributes'] as $key => $attrValue) {
				$values = explode(',',$attrValue);
				foreach($values as $value) {
					$prodAttr[] = ['attribute_id'=> $key,'value'=>$value];
				}
			}
			$product->attributeValues()->createMany($prodAttr);	
		}
		return redirect()->route('admin.products.index')
								->with('status', 'Product updated successfully!');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$product = Product::findOrFail($id);
		$product->delete();

		return response()->json(['message' => 'Deleted product successfully'],200);
	}
	public function uploadImage($var, $request)
	{
		foreach($request->file($var) as $file)
		{
			$name = date('YmdHis').rand().'.'.$file->extension();
			$file->move(public_path().'/files/', $name);
			$data[] = $name;
		}
		return $data;
	}
	public function deleteImage($images)
	{
		foreach($images as $value) {
			$destination = 'files/'.$value;
			if (File::exists($destination)) {
				File::delete($destination);
			}
		}
	}
}