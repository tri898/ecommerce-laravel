<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        $this->cartService->checkProduct();
        return view('front.cart');
    }

    public function store(Product $product, Request $request)
    {
        $cart = session()->get('cart', []);
        
        $key = str_replace(['+', '/', '='], ['-', '_', ''],
            base64_encode($product->id. '-'. $request->options));

        $productPrice = number_format(
            $product->price - ($product->price * ($product->discount/100)), 2);

        if(isset($cart[$key])) {
            $cart[$key]['quantity'] += $request->quantity;
            $cart[$key]['price'] = $productPrice;
        } else {
            $image = json_decode($product->image_list, true);

            $cart[$key] = [
                'id' => $product->id,
                'name' => $product->name,
                'slug' => $product->slug,
                'quantity' => $request->quantity,
                'price' => $productPrice,
                'image' => $image[0],
                'options' => $request->options
            ];
        }
        session()->put('cart', $cart);
        
        return response()->json([
            'message' =>'Add to cart successfully'],201);
    }
    
    public function update($id, Request $request)
    {
        $cart = session()->get('cart');
        if(!isset($cart[$id])) {
            return response()->json([
                'message' =>'Not found product in cart'], 404);
        }

        $product = Product::find($cart[$id]['id']);
        $productPrice = number_format(
            $product->price - ($product->price * ($product->discount/100)), 2);

        if($request->quantity) {
            $cart[$id]['quantity'] = $request->quantity;
            $cart[$id]['price'] = $productPrice;
            session()->put('cart', $cart);
            $totalPrice = number_format($productPrice * $request->quantity, 2);
        }
        return response()->json([
            'message' =>'Update quantity from cart successfully',
            'price' => $productPrice,
            'totalPrice' => $totalPrice,],200);
    }

    public function destroy($id)
    {
        $cart = session()->get('cart');

        if(!isset($cart[$id])) {
            return response()->json([
                'message' =>'Not found product in cart'], 404);
        }
        unset($cart[$id]);
        session()->put('cart', $cart);

        return response()->json([
            'message' =>'Remove product from cart successfully'],200);
    }
}