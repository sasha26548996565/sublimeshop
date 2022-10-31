<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::namespace('App\Http\Controllers')->middleware('verified')->group(function () {
    Route::namespace('Main')->group(function () {
        Route::get('/', 'IndexController')->name('index');
        Route::get('category/{slug}', 'CategoryController@show')->name('category.show');
        Route::get('search/', 'SearchController@search')->name('search');
        Route::get('/product/{slug}', 'ProductController@show')->name('product.show');

        Route::name('cart.')->prefix('cart')->controller('CartController')->group(function () {
            Route::middleware('cart_not_empty')->group(function () {
                Route::get('/', 'index')->name('index');
            });
            Route::post('add/{product}', 'add')->name('add');
        });
    });
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
