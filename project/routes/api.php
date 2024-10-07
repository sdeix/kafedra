<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
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


// Route::middleware('с')->group(function () {
//     Route::get('/products', 'ProductController@index');
//     Route::get('/products/{id}', 'ProductController@show');
//     Route::post('/products', 'ProductController@store');
//     Route::put('/products/{id}', 'ProductController@update');
//     Route::delete('/products/{id}', 'ProductController@destroy');
// });