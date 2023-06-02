<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SingleProductController extends Controller
{
    public function index($id): \Illuminate\Contracts\Support\Renderable
    {
        $product = Product::find($id);
        if ($product == Null){
            return view('errors.404');
        }
        return view('product-single',[
            'product' => Product::find($id),
        ]);

    }
}
