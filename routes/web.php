<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('single-charge', [App\Http\Controllers\HomeController::class, 'singleCharge'])->name('single.charge');
Route::get('/products', [App\Http\Controllers\ProductController::class, 'getAllProducts'])->name('products');
Route::get('/products/{id}', [App\Http\Controllers\ProductController::class, 'viewProducts'])->name('single.products');
Route::post('/products/{id}/checkout', [App\Http\Controllers\ProductController::class, 'checkout'])->name('checkout');

// routes/web.php
Route::get('/thankyou', [App\Http\Controllers\ProductController::class, 'thankYou'])->name('thankyou');
Route::get('logout', [App\Http\Controllers\Auth\LoginController::class,'logout'])->name('logout');
