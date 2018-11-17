<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'categories'], function () {
    Route::get('/', 'CategoryController@index')->name('categories.index');
    Route::get('/{categoryId}', 'CategoryController@show')->where('categoryId', '[0-9]+')->name('categories.show');
    Route::post('/', 'CategoryController@store')->name('categories.store');
    Route::put('/{categoryId}', 'CategoryController@update')->where('categoryId', '[0-9]+')->name('categories.update');
    Route::delete('/{categoryId}', 'CategoryController@destroy')->where('categoryId', '[0-9]+')->name('categories.destroy');
});

Route::group(['prefix' => 'products'], function () {
    Route::get('/', 'ProductController@index')->name('products.index');
    Route::get('/{productId}', 'ProductController@show')->where('productId', '[0-9]+')->name('products.show');
    Route::post('/', 'ProductController@store')->name('products.store');
    Route::put('/{productId}', 'ProductController@update')->where('productId', '[0-9]+')->name('products.update');
    Route::delete('/{productId}', 'ProductController@destroy')->where('productId', '[0-9]+')->name('products.destroy');
});

Route::post('order', 'OrderController@makeOrder');
