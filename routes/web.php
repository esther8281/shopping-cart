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
    return view('welcome');
});
// Route::get('/', 'HomeController@home');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('/product')->group(function () {
		Route::get('/', 'ProductController@index');
		Route::get('/create', 'ProductController@create');
    	Route::post('/', 'ProductController@store');
    	Route::get('/{product}/edit', 'ProductController@edit');
    	Route::put('/{product}/update', 'ProductController@update');
     	Route::get('/{product}/destroy', 'ProductController@destroy');	     	
});

Route::prefix('/shopping-product')->group(function () {
	Route::get('/', 'ProductController@shoppingpProduct');   
	     	
	});

Route::prefix('/cart')->group(function () {
	Route::get('/', 'CartController@index');

    Route::get('/{product}/add-to-cart', 'CartController@addCart');
});
