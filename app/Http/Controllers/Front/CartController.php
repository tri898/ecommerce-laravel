<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return view('front.cart');
    }

    public function store(Product $product, Request $request)
    {
        $cart = session()->get('cart', []);
        
        $key = str_replace(['+', '/', '='], ['-', '_', ''],
            base64_encode($product->id. '-'. $request->options));

        if(isset($cart[$key])) {
            $cart[$key]['quantity'] += $request->quantity;
            $cart[$key]['price'] = $request->price;
        } else {
            $image = json_decode($product->image_list, true);

            $cart[$key] = [
                'id' => $product->id,
                'name' => $product->name,
                'slug' => $product->slug,
                'quantity' => $request->quantity,
                'price' => $request->price,
                'image' => $image[0],
                'options' => $request->options
            ];
        }
        
        session()->put('cart', $cart);
        
        return response()->json('Add to cart successfully',201);
    }
    public function update($id, Request $request)
    {
        $cart = session()->get('cart');
        if($request->quantity) {
            $cart[$id]['quantity'] = $request->quantity;
            $totalPrice =  number_format($cart[$id]['price'] * $request->quantity, 2);
            session()->put('cart', $cart);
        }
        return response()->json([
            'message' =>'Update quantity from cart successfully',
            'totalPrice' => $totalPrice],200);
    }

    public function destroy($id)
    {
        $cart = session()->get('cart');

            if(isset($cart[$id])) {
                unset($cart[$id]);
                session()->put('cart', $cart);
            }
        return response()->json('Remove product from cart successfully',200);
    }
}
