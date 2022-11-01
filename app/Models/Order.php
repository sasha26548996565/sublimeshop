<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function products(): Relation
    {
        return $this->belongsToMany(Product::class, 'order_product', 'order_id', 'product_id')->withPivot('count')->withTimestamps();
    }

    public function shipping(): Relation
    {
        return $this->belongsTo(Shipping::class, 'shipping_id', 'id');
    }

    public function coupon(): Relation
    {
        return $this->belongsTo(Coupon::class, 'coupon_id', 'id');
    }

    public function getSubTotalPrice(): float
    {
        $totalPrice = 0;

        foreach ($this->products as $product)
        {
            $totalPrice += $product->getPriceForCount();
        }

        return $totalPrice;
    }

    public function getTotalPrice(): float
    {
        $totalPrice = $this->getSubTotalPrice();

        if (! is_null($this->shipping))
        {
            $totalPrice += $this->shipping->price;
        }

        return $totalPrice;
    }

    public function getTotalPriceWithCoupon(): float
    {
        $totalPrice = $this->getTotalPrice();

        if (! is_null($this->coupon))
        {
            $totalPrice = round($totalPrice - ($totalPrice * $this->coupon->discount / 100), 2);
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
