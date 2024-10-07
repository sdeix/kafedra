<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
    Route::get('/logout', 'logout')->middleware("checktoken");
});

Route::get('/products',[ProductController::class,"index"]);

Route::controller(CartController::class)->group(function () {
    Route::post('/cart/add/{productId}', 'addProduct');
    Route::get('/cart', 'getCart');
});
Route::middleware('checktoken')->group(function () {
    Route::post('/cart/{product_id}', [CartController::class,'addProduct']);
    Route::delete('/cart/{product_id}', [CartController::class,'removeProduct']);
    Route::get('/cart', [CartController::class,'getCart']);


    Route::get('/order', [OrderController::class,'getOrders']);
    Route::post('/order', [OrderController::class,'checkout']);
});