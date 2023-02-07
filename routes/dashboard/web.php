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
Route::group(['prefix' => 'dashboard','as' => 'dashboard.'],
function(){

    Route::group(['namespace' => 'Auth'], function () {
        // Authentication Routes...
        Route::get('login', 'LoginController@showLoginForm')->name('login');
        Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
        Route::post('register', 'RegisterController@register')->name('register');
        Route::post('login', 'LoginController@login')->name('login');
        Route::post('logout', 'LoginController@logout')->name('logout');
    });

    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/', 'DashboardController@index')->name('index');
        Route::get('/admins/{admin}/permissions', 'AdminController@editPermissions')->name('admins.permissions.edit');
        Route::post('/admins/{admin}/permissions', 'AdminController@updatePermissions')->name('admins.permissions.update');
        Route::resource('admins', 'AdminController');
        Route::resource('categories', 'CategoryController');
        Route::resource('brands', 'BrandController');
        Route::resource('factory-cars', 'FactoryCarController');
        Route::resource('cars', 'CarController');
        Route::resource('products', 'ProductController');
    });

});
});
