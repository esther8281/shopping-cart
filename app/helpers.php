<?php

use App\Cart;
use Illuminate\Database\Eloquent\Relations\Relation;
   

if (! function_exists('checkInCart')) {
    function checkInCart($product_id)
    {
        $guest_session_id = session()->getId();
        $cart_items = Cart::where('guest_session_id', $guest_session_id)
                                ->get();

        if($cart_items->contains('product_id',$product_id))
            return true;
        return false;
    }
}


