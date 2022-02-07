<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class StateCityController extends Controller
{
    public function getCitiesOfState($id)
    {
        $cities = City::where('state_id', $id)->get('name');

        return response()->json($cities);
    }
}
