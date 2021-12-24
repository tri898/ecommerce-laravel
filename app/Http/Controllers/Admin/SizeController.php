<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Size;
use App\Http\Requests\SizeRequest;
use Illuminate\Http\Request;
use DataTables;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            $sizes = Size::latest()->get();
           
            return DataTables::of($sizes)
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
        return view('admin.sizes.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SizeRequest $request)
    {
        $fields = $request->validated(); 
        $size= Size::create($fields);

        return response()->json(['message' => 'Created size successfully'],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $size = Size::findOrFail($id);

        return response()->json($size);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SizeRequest $request, $id)
    {
        $fields = $request->validated(); 

        $size = Size::findOrFail($id);

        $size->update($fields);

        return response()->json(['message' => 'Updated size successfully'],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $size = Size::findOrFail($id);
        
        $size->delete();
        return response()->json(['message' => 'Deleted size successfully'],200);
    }
}
