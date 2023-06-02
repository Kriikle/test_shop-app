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

Route::get('/', function () {
    return view('home');
});
Route::get('/home', function () {
    return view('home');
});
Route::get('/shop', function () {
    return view('shop');
});
Route::get('/shop', [App\Http\Controllers\ShopController::class, 'index'])
    ->name('shop');
# Actually must rewrite on rest api /CategoryProducts/{id}
Route::get('/CategoryProducts/{id}', [App\Http\Controllers\ShopController::class, 'CategoryProducts'])
    ->name('CategoryProducts');
Route::get('/product/{id}', [App\Http\Controllers\SingleProductController::class, 'index'])
    ->name('index');

Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])
    ->name('cart');

Route::get('/contact', function () {
    return view('contact');
});

