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
        // admins routes
        Route::get('/admins/{admin}/permissions', 'AdminController@editPermissions')->name('admins.permissions.edit');
        Route::post('/admins/{admin}/permissions', 'AdminController@updatePermissions')->name('admins.permissions.update');
        Route::resource('admins', 'AdminController');
        Route::resource('cars', 'CarController');
        Route::post('/cars/ajax', 'CarController@ajaxIndex')->name('cars.ajax');
        Route::resource('orders', 'OrderController');
        Route::resource('clients', 'ClientController');
        Route::resource('settings', 'SettingController');
        // factory cars routes
        Route::resource('factory-cars', 'FactoryCarController');
        Route::post('/import-factoryCars','FactoryCarController@import')->name('import-factoryCars');
        Route::get('/export-factoryCars','FactoryCarController@exportfactoryCars')->name('export-factoryCars');
        // categories routes
        Route::resource('categories', 'CategoryController');
        Route::post('/import-categories','CategoryController@import')->name('import-categories');
        Route::get('/export-categories','CategoryController@exportCategories')->name('export-categories');
        // cars routes
        Route::resource('cars', 'CarController');
        Route::post('/import-cars','CarController@import')->name('import-cars');
        Route::get('/export-cars','CarController@exportCars')->name('export-cars');
        // brands routes
        Route::resource('brands', 'BrandController');
        Route::post('/import-brands','BrandController@import')->name('import-brands');
        Route::get('/export-brands','BrandController@exportBrands')->name('export-brands');
        // products routes
        Route::resource('products', 'ProductController');
        Route::post('/import-products','ProductController@import')->name('import-products');
        Route::get('/export-products','ProductController@exportProducts')->name('export-products');
    });

});
});
