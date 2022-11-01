<?php

declare(strict_types=1);

namespace App\Http\Controllers\Main;

use App\Events\ConfirmCheckout;
use App\Models\City;
use App\Models\Order;
use App\Models\Country;
use App\Models\Province;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Http\Requests\Main\CheckoutRequest;
use Illuminate\Http\RedirectResponse;

class CheckoutController extends Controller
{
    public function index(): View
    {
        $order = Order::findOrFail(session('orderId'));
        $countries = Country::latest()->get();
        $provinces = Province::latest()->get();
        $cities = City::latest()->get();

        return view('checkout', compact('order', 'countries', 'provinces', 'cities'));
    }

    public function confirm(CheckoutRequest $request): RedirectResponse
    {
        $order = Order::findOrFail(session('orderId'));
        $order->status = 1;
        $order->update($request->validated());
        event(new ConfirmCheckout($order));

        session()->forget('orderId');

        return to_route('index');
    }
}
