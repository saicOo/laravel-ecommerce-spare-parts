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
    Route::get('/products', 'ProductController@index')->name('products.index');
    Route::get('/products/{product}', 'ProductController@show')->name('products.show');

    Route::resource('users', 'UserController');
    Route::resource('carts', 'CartController')->only(['index','store','update']);
    Route::resource('orders', 'OrderController');
    Route::resource('checkout', 'CheckoutController');
});
