<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Http\Requests\SliderRequest;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use DataTables;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         if($request->ajax()) {
            $sliders = Slider::with('product:id,name')->latest()->get();
           
            return DataTables::of($sliders)
                                ->addIndexColumn()
                                ->addColumn('actions', function($row) {
                                    return '<a href="javascript:void(0)" onclick="onEdit(event.currentTarget)"
                                             data-id="'.$row['id'].'" class="btn btn-warning"><i class="lnr lnr-pencil"></i></a>
                                            <a href="javascript:void(0)" onclick="onDelete(event.currentTarget)"
                                             data-id="'.$row['id'].'" class="btn btn-danger"><i class="lnr lnr-trash"></i></a>';
                                })
                                ->rawColumns(['actions'])
                                ->make(true);
        }
        return view('admin.sliders.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SliderRequest $request)
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
        $slider = Slider::with('product:id,name')->findOrFail($id);

        return response()->json($slider);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SliderRequest $request, $id)
    {
        $slider = Slider::findOrFail($id);

        $fields = $request->safe()->except(['image','old_image']); 
        if($request->hasfile('image')) {
            Helper::deleteImage(explode(' ',$request->old_image));
		    $fields['image'] = implode(Helper::uploadImage($request->image));
		}
        $slider->update($fields);
        return response()->json(['message' => 'Updated slider successfully'],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);
		Helper::deleteImage(explode(' ',$slider->image));
		$slider->delete();

		return response()->json(['message' => 'Deleted slider successfully'],200);
    }
}