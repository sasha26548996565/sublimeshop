<?php

declare(strict_types=1);

namespace App\Http\Controllers\Main;

use App\Models\Subscription;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class SubscriptionController extends Controller
{
    public function subscribtion(): RedirectResponse
    {
        Subscription::create(['user_id' => Auth::user()->id]);

        return to_route('index');
    }
}
