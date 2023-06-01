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
            $data['title'] = '404';
            $data['name'] = 'Page not found';
            return view('errors.404',$data,);
        }
        return view('product-single',[
            'product' => Product::find($id),
        ]);

    }
}
