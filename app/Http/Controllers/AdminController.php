<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function deleteProduct(Request $request)
    {
        if (Auth::user()->admin() != Null){
            if (isset($_POST['id_product'])){
                Product::where('id', $_POST['id_product'])->delete();
            }
        }

        return redirect(url('/admin'));
    }


    public function updateProduct(Request $request)
    {
        if (Auth::user()->admin() != Null){
            if (isset($_POST['id_product'])) {
                $id = $_POST['id_product'];
                $product = Product::find($id);
                $product->name = $_POST['name'];
                $product->prize = $_POST['prize'];
                $product->description = $_POST['description'];
                if($request->hasFile('img')) {
                    $request->validate([
                        'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                    ]);
                    $file = $request->file('img');
                    $nameImage = 'product-' . $id . '.jpg';
                    $pathImage = public_path() . '/assets/images/products/'. $id.'/';
                    $file->move($pathImage, $nameImage);
                    $image = new Image(['path' => '/assets/images/products/'. $id.'/' . $nameImage]);
                    $image->save();
                    $product->image_preview_id = $image->id;
                }
                $product->save();
            }
        }

        return redirect(url('/admin'));
    }

    public function addProduct(Request $request)
    {
        if (Auth::user()->admin() != Null) {
            $product = new Product();
            $product->name = $_POST['name'];
            $product->prize = $_POST['prize'];
            $product->description = $_POST['description'];
            $product->category_id = $_POST['category_id'];
            $request->validate([
                'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);
            if($request->hasFile('img')) {
                $file = $request->file('img');
                if (Product::find(1) != Null){
                    $idProduct = Product::find(\DB::table('products')->max('id'))->id + 1;
                } else {
                    $idProduct = 1;
                }
                $nameImage = 'product-' . $idProduct . '.jpg';
                $pathImage = public_path() . '/assets/images/products/'.$idProduct.'/';
                $file->move($pathImage,$nameImage);
                $image = new Image(['path' => '/assets/images/products/'. $idProduct.'/' . $nameImage]);
                $image->save();
                $product->image_preview_id = $image->id;
            } else{

                return redirect(url('/admin'));
            }
            $product->save();
        }

        return redirect(url('/admin'));
    }

    public function updateCategory()
    {
        if (Auth::user()->admin() != Null){
            if (isset($_GET['id_category'])) {
                $category = Category::find($_GET['id_category']);
                $category->name = $_GET['name'];
                $category->description = $_GET['description'];
                $category->save();
            }
        }

        return redirect(url('/admin'));
    }

    public function addCategory(Request $request)
    {
        if (Auth::user()->admin() != Null) {
            $name = $request->input('name');
            if ($name != Null) {
                $description = $request->input('description');
                $category = new Category([
                    'name' => $name,
                    'description' => $description,
                ]);
                $category->save();
            }
        } else {
            $msg = 'Field category name is Null';
        }
        return redirect(url('/admin'));
    }

    public function deleteCategory(Request $request)
    {
        if (Auth::user()->admin() != Null){
            if (isset($_POST['id_category'])) {
                Category::where('id', $_POST['id_category'])->delete();
            }
        }
        return redirect(url('/admin'));
    }

    public function admin(): Renderable
    {

        return view('admin.admin',[
            'products' => Product::all(),
            'categories' => Category::all()
        ]);
    }
}
