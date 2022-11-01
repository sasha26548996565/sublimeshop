<?php

declare(strict_types=1);

namespace App\Http\Controllers\Main;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\CartService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CartController extends Controller
{
    private CartService $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index(): View
    {
        $order = Order::findOrFail(session('orderId'));

        return view('cart', compact('order'));
    }

    public function add(Request $request, Product $product): RedirectResponse
    {
        $orderId = session('orderId');

        if (is_null($orderId))
        {
            $order = Order::create();
            session(['orderId' => $order->id]);
        } else
        {
            $order = Order::findOrFail($orderId);
        }

        $this->cartService->add($order, $product, (int) $request->quantity);

        return to_route('cart.index', compact('order'));
    }

    public function remove(Product $product): RedirectResponse
    {
        $order = Order::findOrFail(session('orderId'));
        $order->products()->detach($product->id);

        if (count($order->products) > 0)
            return to_route('cart.index', compact('order'));

        return to_route('index');
    }

    public function clear(): RedirectResponse
    {
        $order = Order::findOrFail(session('orderId'));
        $order->products()->detach();

        session()->forget('orderId');

        return to_route('index');
    }
}
