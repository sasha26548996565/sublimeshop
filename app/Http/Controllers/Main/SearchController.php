<?php

declare(strict_types=1);

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request): View
    {
        $products = Product::where('name', 'LIKE', '%'. $request->search .'%')->paginate(8);
        return view('index', compact('products'));
    }
}
