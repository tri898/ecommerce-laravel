<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $userId = auth()->user()->id;
        $orders = Order::select(['id','status','total'])
            ->with('products')
            ->where('user_id',$userId)
            ->paginate(10);
        
        return view('user.orders.index', compact('orders'));
    }
}
