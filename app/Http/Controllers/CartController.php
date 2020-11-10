<?php

namespace App\Http\Controllers;

use App\User;
use App\Cart;
use App\Product;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        \View::share('page_name', 'Cart');
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $cart_items = Cart::where('guest_session_id', session('guest_session_id'))
                                ->with('product')
                                ->get();
    
        return view('pages.front-end.product_cart', [
            'cart_items' => $cart_items,
        ]);
    }
  
   

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addCart($product)
    {
        $guest_session_id = null;
        $guest_session_id = session()->getId();

        session(['guest_session_id' => $guest_session_id]);

        $cart_item = Cart::where('guest_session_id', $guest_session_id)
                                ->where('product_id', $product)
                                ->first();
        
        $product_m = Product::find($product);

        $cart_item = Cart::create([
            'guest_session_id' => $guest_session_id,
            'product_id' => $product,
            'quantity' => 1,
            'price' => $product_m->price,
        ]);

        return redirect()->back();
    }

    


}
