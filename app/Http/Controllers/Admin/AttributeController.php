<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Http\Requests\AttributeRequest;
use Illuminate\Http\Request;
use DataTables;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            $attributes = Attribute::latest()->get();
           
            return DataTables::of($attributes)
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
        return view('admin.attributes.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttributeRequest $request)
    {
        $fields = $request->validated(); 
        $attribute= Attribute::create($fields);

        return response()->json(['message' => 'Created attribute successfully'],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $attribute = Attribute::findOrFail($id);

        return response()->json($attribute);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AttributeRequest $request, $id)
    {
        $fields = $request->validated(); 

        $attribute = Attribute::findOrFail($id);

        $attribute->update($fields);

        return response()->json(['message' => 'Updated attribute successfully'],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $attribute = Attribute::findOrFail($id);
        $attribute->delete();

        return response()->json(['message' => 'Deleted attribute successfully'],200);
    }
}
