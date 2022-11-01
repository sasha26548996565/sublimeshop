<?php

declare(strict_types=1);

namespace App\Http\Controllers\Main;

use App\Models\Order;
use App\Models\Coupon;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Main\CouponRequest;

class CouponController extends Controller
{
    public function add(CouponRequest $request): RedirectResponse
    {
        $coupon = Coupon::findOrFail($request->validated()['name']);
        $order = Order::findOrFail(session('orderId'));
        $order->coupon()->associate($coupon->id)->save();

        return redirect()->back();
    }
}
