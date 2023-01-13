<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CartService
{
    public function add(Order $order, Product $product, int $quantity): void
    {
        if (! $order->products->contains($product->id))
            $order->products()->attach($product->id);

        $pivotRow = $this->getPivotRow($order, $product);
        $pivotRow->count = $quantity;
        $pivotRow->update();
    }

    private function getPivotRow(Order $order, Product $product): Pivot
    {
        return $order->products()->where('product_id', $product->id)->first()->pivot;
    }
}
