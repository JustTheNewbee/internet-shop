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

Route::group(['prefix' => 'categories'], function ($api) {
    Route::get('/{categoryId}', 'CategoryController@show')->where('categoryId', '[0-9]+')->name('categories.show');
    Route::post('/', 'CategoryController@store')->name('categories.store');
    Route::put('/{categoryId}', 'CategoryController@update')->where('categoryId', '[0-9]+')->name('categories.update');
    Route::delete('/{categoryId}', 'CategoryController@destroy')->where('categoryId', '[0-9]+')->name('categories.destroy');
});
