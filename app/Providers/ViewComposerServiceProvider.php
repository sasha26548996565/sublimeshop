<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use App\ViewComposers\CategoryComposer;
use App\ViewComposers\ShippingComposer;
use Illuminate\Support\ServiceProvider;
use App\ViewComposers\CountElementInCart;
use App\ViewComposers\LatestProductComposer;

class ViewComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('includes.home', LatestProductComposer::class);
        View::composer('includes.header', CategoryComposer::class);
        View::composer('includes.header', CountElementInCart::class);
        View::composer('cart', ShippingComposer::class);
    }
}
