<?php

declare(strict_types=1);

namespace App\ViewComposers;

use App\Models\Product;
use Illuminate\Contracts\View\View;

class LatestProductComposer implements ViewComposerContract
{
    public function compose(View $view): View
    {
        return $view->with('latestProducts', Product::latest()->take(3)->get());
    }
}
