<?php

declare(strict_types=1);

namespace App\Http\Controllers\Main;

use App\Models\Order;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class ShippingController extends Controller
{
    public function setShipping(Request $request): JsonResponse
    {
        $shipping = Shipping::findOrFail($request->shippingId);
        $order = Order::findOrFail(session('orderId'));
        $order->shipping()->associate($shipping->id)->save();

        return response()->json(['shippingName' => $shipping->name]);
    }
}
