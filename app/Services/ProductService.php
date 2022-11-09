<?php

declare(strict_types=1);

namespace App\Services;

use App\DTO\ProductDTO;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    public function store(ProductDTO $product): Product
    {
        $product->image = Storage::disk('public')->put('/images/products', $product->image);
        $product = Product::create($product->toArray());

        return $product;
    }
}
