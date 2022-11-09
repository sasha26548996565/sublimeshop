<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Requests\Main\CheckoutRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class OrderController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return OrderResource::collection(Order::getActive()->get());
    }

    public function store(CheckoutRequest $request): OrderResource
    {
        return new OrderResource(Order::create($request->validated()));
    }

    public function show(Order $order): OrderResource
    {
        return new OrderResource($order);
    }

    public function update(Order $order, CheckoutRequest $request): OrderResource
    {
        $order->update($request->validated());
        return new OrderResource($order);
    }

    public function destroy(Order $order): Response
    {
        $order->delete();

        return response(Response::HTTP_NO_CONTENT);
    }
}
