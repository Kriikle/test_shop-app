<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Auth::routes(['verify' => true]);
#Errors
Route::get('/404', function () {
    return view('errors.404');
});
Route::get('/401', function () {
    return view('errors.401');
});


Route::get('/', function () {
    return view('home');
});
Route::get('/home', function () {
    return view('home');
});

# Shop
Route::get('/shop', [App\Http\Controllers\ShopController::class, 'index'])
    ->name('shop');
# Actually must rewrite on rest api /CategoryProducts/{id}
Route::get('/CategoryProducts/{id}', [App\Http\Controllers\ShopController::class, 'CategoryProducts'])
    ->name('CategoryProducts');
Route::post('/addToCart/', [App\Http\Controllers\ShopController::class, 'addToCart'])
    ->name('addToCart');
Route::get('/product/{id}', [App\Http\Controllers\SingleProductController::class, 'index'])
    ->name('index');

# Cart
Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])
    ->name('cart');
Route::post('/cartDelete', [App\Http\Controllers\CartController::class, 'cartDelete'])
    ->name('cartDelete');

Route::get('/contact', function () {
    return view('contact');
});

Route::prefix('admin')->group(function () {
    Route::get('/', [App\Http\Controllers\AdminController::class, 'admin'])
        ->name('admin')
        ->middleware('auth');;
    Route::post('/deleteProduct', [App\Http\Controllers\AdminController::class, 'deleteProduct'])
        ->name('admin_product_del');
    Route::post('/updateProduct', [App\Http\Controllers\AdminController::class, 'updateProduct'])
        ->name('admin_product_update');
    Route::post('/createProduct', [App\Http\Controllers\AdminController::class, 'addProduct'])
        ->name('admin_product_add');
    Route::post('/deleteCategory', [App\Http\Controllers\AdminController::class, 'deleteCategory'])
        ->name('deleteCategory');
    Route::post('/updateCategory', [App\Http\Controllers\AdminController::class, 'updateCategory'])
        ->name('admin_Category_update');
    Route::post('/createCategory', [App\Http\Controllers\AdminController::class, 'addCategory'])
        ->name('admin_Category_add');
});
