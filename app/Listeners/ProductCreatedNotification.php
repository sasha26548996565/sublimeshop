<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Models\Product;
use App\Jobs\ProductCreatedJob;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProductCreatedNotification
{
    public function handle($event): void
    {
        ProductCreatedJob::dispatch($event->product, Auth::user()->email);
    }
}
