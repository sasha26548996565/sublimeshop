<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Order;
use Illuminate\Http\Request;

class CartNotEmpty
{
    public function handle(Request $request, Closure $next)
    {
        $orderId = session('orderId');

        if (is_null($orderId))
            return redirect()->back();

        $order = Order::findOrFail($orderId);

        if ($order->getTotalQuantity() <= 0)
            return redirect()->back();

        return $next($request);
    }
}
