<?php

declare(srtict_types=1);

namespace App\ViewComposers;

use App\Models\Shipping;
use App\ViewComposers\ViewComposerContract;
use Illuminate\Contracts\View\View;

class ShippingComposer implements ViewComposerContract
{
    public function compose(View $view): View
    {
        return $view->with('shippings', Shipping::latest()->get());
    }
}
