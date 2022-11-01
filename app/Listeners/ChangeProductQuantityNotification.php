<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Models\Order;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ChangeProductQuantityNotification
{
    public function handle($event): void
    {
        foreach ($event->order->products as $product)
        {
            $product->quantity -= $product->pivot->count;
            $product->save();
        }
    }
}
