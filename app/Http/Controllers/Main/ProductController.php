<?php

declare(strict_types=1);

namespace App\Http\Controllers\Main;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function show(string $slug): View
    {
        $product = Product::where('slug', $slug)->first();
        $relatedProducts = Product::where('category_id', $product->category->id)->latest()->paginate(4);

        return view('product', compact('product', 'relatedProducts'));
    }
}
