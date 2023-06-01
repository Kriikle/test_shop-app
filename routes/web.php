<?php

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

Route::get('/', function () {
    return view('home');
});
Route::get('/shop', function () {
    return view('shop');
});
Route::get('/shop', [App\Http\Controllers\ShopController::class, 'index'])
    ->name('shop');
Route::get('/CategoryProducts/{id}', [App\Http\Controllers\ShopController::class, 'CategoryProducts'])
    ->name('CategoryProducts');

Route::get('/cart', function () {
    return view('cart');
});
Route::get('/contact', function () {
    return view('contact');
});

