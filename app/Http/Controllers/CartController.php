<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function cartDelete(Request $request){
        $id = $request->input('id_cart');
        $cart = Cart::find($id);
        if ($cart == null){
            return redirect('/404');
        }
        if (Auth::id() != $cart->user_id){
            return redirect('/401');
        }
        $cart->delete();
        return redirect('/cart');
    }


    public function index(): \Illuminate\Contracts\Support\Renderable
    {
        $user = Auth::user();
        $myCart = Null;
        $myCart = $user?->carts()->get();
        return view('cart', [
            'myCart' => $myCart
        ]);
    }
}
