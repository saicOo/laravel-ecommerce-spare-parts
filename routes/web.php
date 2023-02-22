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
Route::group(['prefix' => LaravelLocalization::setLocale(),
'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]],
function(){
    Auth::routes();

    Route::get('/', 'HomeController@index');
    // products routes
    Route::get('/products', 'ProductController@index')->name('products.index');
    Route::get('/products/{product}', 'ProductController@show')->name('products.show');
    // users routes
    Route::resource('users', 'UserController')->only(['index','update']);
    // carts routes
    Route::resource('carts', 'CartController')->only(['index','store','update']);
    // order route get
    Route::get('/orders/{order}', 'OrderController@show')->name('orders.show');
    // checkout routes
    Route::resource('checkout', 'CheckoutController')->only(['create','store']);
    Route::get('/callback', 'CheckoutController@callback')->name('callback');

});
