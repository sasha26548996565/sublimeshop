<?php

declare(strict_types=1);

namespace App\Http\Controllers\Main;

use App\DTO\ProductDTO;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\ProductService;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Main\ProductRequest;

class ProductController extends Controller
{
    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function show(string $slug): View
    {
        $product = Product::where('slug', $slug)->first();
        $relatedProducts = Product::where('category_id', $product->category->id)->latest()->paginate(4);

        return view('product.show', compact('product', 'relatedProducts'));
    }

    public function create(): View
    {
        $categories = Category::latest()->get();

        return view('product.create', compact('categories'));
    }

    public function store(ProductRequest $request): RedirectResponse
    {
        $product = $this->productService->store(new ProductDTO($request->validated()));

        return to_route('product.show', $product->slug);
    }
}
