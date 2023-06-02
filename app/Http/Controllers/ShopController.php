<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function addToCart(Request $request){
        $id = $request->input('id_product');
        $product = Product::find($id);
        if ($product == Null){
            return view('errors.404');
        }
        $user = Auth::user();
        if ($user == Null){
            return view('errors.401');
        }

        $userCarts = $user->carts();
        $cart = $userCarts->firstWhere('product_id', $product->id);
        var_dump($cart);
        if ($cart == Null) {
            $cart = new Cart([
                'product_id' => $product->id,
                'user_id' => $user->id,
                'prize' => $product->prize,
                'count' => '1',
                'size' => 190,
            ]);
        } else {
            $cart->count += 1;
        }
        $cart->save();
        return redirect('/shop');
    }
    public function categoryProducts($id)
    {
        $category = Category::find($id);
        if ($category == Null){
            return redirect('/shop');
        }
        return view('shop',[
            'products' => $category->products,
            'categories' => Category::all()
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(): \Illuminate\Contracts\Support\Renderable
    {
        return view('shop',[
            'products' => Product::all(),
            'categories' => Category::all()
        ]);

    }
}
