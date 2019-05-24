<?php

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

Route::get('/', 'ProductController@show')->name('products.list');
Route::group(['prefix'=>'products'], function (){
    Route::get('/create', 'ProductController@create')->name('products.create');
    Route::get('/home', 'ProductController@home')->name('products.home');
    Route::post('/create', 'ProductController@store')->name('products.store');
    Route::get('/delete{id}', 'ProductController@delete')->name('products.delete');
});

Route::group(['prefix'=>'cart'], function (){
    Route::get('{id}/add', 'ShoppingCartController@add')->name('cart.add');
    Route::get('list', 'ShoppingCartController@index')->name('cart.index');
    Route::get('destroy/{id}', 'ShoppingCartController@destroy')->name('cart.destroy');
    Route::post('update/{id}', 'ShoppingCartController@update')->name('cart.update');
});