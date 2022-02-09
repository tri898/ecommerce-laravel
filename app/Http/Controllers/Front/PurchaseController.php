<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\{State, Order};
use App\Services\CartService;

class PurchaseController extends Controller
{   
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {   
        $cart = session()->get('cart', []);

        if(empty($cart)) {
            return redirect()->route('front.cart.index');
        }
        $this->cartService->checkProduct();

        $states = State::get(['id', 'name']);
        return view('front.purchase', compact('states'));
    }

    public function store(OrderRequest $request)
    {
        $this->cartService->checkProduct();

        $cart = session()->get('cart', []);
        if ($cart) {
        	$subtotal = 0;
           	foreach($cart as $value) {
        		$subtotal += $value['quantity'] * $value['price'];
           	}

            $address = $request->address . ' - ' . $request->state . ' - ' . $request->city;
			$order = Order::create([
				'name' => $request->name,
				'address' => $address,
				'phone' => $request->phone,
				'user_id' => auth()->user()->id,
				'shipping_fee' => 15,
				'subtotal' => $subtotal,
				'total' => $subtotal + 15,
				'note' => $request->note
			]);

            foreach($cart as $value) {
        		$order->products()->attach($value['id'],[
                    'options' => $value['options'],
                    'quantity' => $value['quantity'],
                    'price' => $value['price'],
                    'total' => $value['quantity'] * $value['price'],
                ]);
           	}
            
            session()->forget('cart');
        } 
        return redirect()->route('front.cart.index')
            ->with('success','Create order successfully');
    }

}
