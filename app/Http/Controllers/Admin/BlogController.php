<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Http\Requests\BlogRequest;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DataTables;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
			$blogs = Blog::with('user:id,name')->latest()
				->get(['id','title','user_id']);
			return DataTables::of($blogs)
								->addIndexColumn()
								->addColumn('actions', function($row) {
									return '<a href="/admin/blogs/'.$row['id'].'/edit" class="btn btn-warning">
											<i class="lnr lnr-pencil"></i></a>
											<a href="javascript:void(0)" onclick="onDelete(event.currentTarget)"
											 data-id="'.$row['id'].'" class="btn btn-danger"><i class="lnr lnr-trash"></i></a>
											<a href="javascript:void(0)" onclick="onShow(event.currentTarget)"
											 data-id="'.$row['id'].'" class="btn btn-success"><i class="lnr lnr-eye"></i></a>
											 ';
								})
								->rawColumns(['actions'])
								->make(true);
		}
		return view('admin.blogs.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fields = $request->safe()->except(['image','old_image']); 
        if($request->hasfile('image')) {
		    $fields['image'] = implode(Helper::uploadImage($request->image));
		}
        $slider = Slider::create($fields);
        return response()->json(['message' => 'Created slider successfully'],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
