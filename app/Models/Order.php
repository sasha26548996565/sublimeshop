<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Order extends Model
{
    use HasFactory;

    protected $guraded = [];

    public function products(): Relation
    {
        return $this->belongsToMany(Product::class, 'order_product', 'order_id', 'product_id')->withPivot('count')->withTimestamps();
    }

    public function getTotalPrice(): float
    {
        $totalPrice = 0;

        foreach ($this->products as $product)
        {
            $totalPrice += $product->getPriceForCount();
        }

        return $totalPrice;
    }

    public function getTotalQuantity(): int
    {
        $quantity = 0;

        foreach ($this->products as $product)
        {
            $quantity += $product->pivot->count;
        }

        return $quantity;
    }
}
