<?php

declare(strict_types=1);

namespace App\ViewComposers;

use App\Models\Order;
use Illuminate\Contracts\View\View;

class CountElementInCart implements ViewComposerContract
{
    public function compose(View $view): View
    {
        $orderId = session('orderId');
        if (is_null($orderId))
        {
            $countElementInCart = 0;
        } else
        {
            $order = Order::findOrFail($orderId);
            $countElementInCart = $order->getTotalQuantity();
        }

        return $view->with('countElementInCart', $countElementInCart);
    }
}
