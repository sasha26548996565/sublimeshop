<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::namespace('App\Http\Controllers')->middleware('verified')->group(function () {
    Route::namespace('Main')->group(function () {
        Route::get('/', 'IndexController')->name('index');
        Route::get('/category/{slug}', 'CategoryController@show')->name('category.show');
        Route::get('/search', 'SearchController@search')->name('search');
        Route::post('/subscription', 'SubscriptionController@subscribtion')->name('subscription');

        Route::name('product.')->prefix('product')->controller('ProductController')->group(function () {
            Route::get('/show/{slug}', 'show')->name('show');

            Route::middleware('permission:create-product')->group(function () {
                Route::get('/create', 'create')->name('create');
                Route::post('/store', 'store')->name('store');
            });
        });

        Route::name('cart.')->prefix('cart')->group(function () {
            Route::controller('CartController')->group(function () {
                Route::middleware('cart_not_empty')->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::post('remove/{product}', 'remove')->name('remove');
                    Route::get('/clear', 'clear')->name('clear');
                });

                Route::post('add/{product}', 'add')->name('add');
            });

            Route::get('shipping/set', 'ShippingController@setShipping')->name('shipping.setShipping');

            Route::post('/coupon/add', 'CouponController@add')->name('coupon.add');

            Route::name('checkout.')->prefix('checkout')->middleware('cart_not_empty')->controller('CheckoutController')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::post('/confirm', 'confirm')->name('confirm');
            });
        });
    });
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
