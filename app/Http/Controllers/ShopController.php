<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function CategoryProducts($id): \Illuminate\Contracts\Support\Renderable
    {
        $category = Category::find($id);
        if ($category == Null){
            return $this->index();
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
