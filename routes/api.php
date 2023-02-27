<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/callback', 'Front\CheckoutController@callbackApi');

Route::group(['namespace' => 'Api'], function () {
    Route::get('/cars/{car}','CarController@show')->name('api-car.show');
    Route::get('/cars','CarController@index')->name('api-car.index');
    Route::get('/products','ProductController@index')->name('api-product.index');
    Route::get('/products/{product}','ProductController@show')->name('api-product.show');
});
