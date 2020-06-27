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

Route::get('/', 'HomeController@index')->name('site');

Route::get('/produto/{slug}', 'HomeController@single')->name('single');

Route::group(['prefix' => 'cart'], function () {
    Route::post('/add', 'CartController@add')->name('cart.add');
    Route::get('/', 'CartController@index')->name('cart.index');
    Route::get('/remove/{slug}', 'CartController@remove')->name('cart.remove');
});

Route::get('/admin', function () {
    return view('home');
})->name('home')->middleware('auth');

Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'admin','namespace' => 'Admin'], function () {
        Route::resource('stores', 'StoreController')->names('admin.stores');
    
        Route::resource('products', 'ProductController')->names('admin.products');

        Route::resource('categories', 'CategoryController')->names('admin.categories');

        Route::post('photos/remove/{productPhotoId}', 'ProductPhotoController@removePhoto')->name('admin.product.photo.remove');
    });
});

Auth::routes();
