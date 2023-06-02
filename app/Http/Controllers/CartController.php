<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

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
