<?php

declare(strict_types=1);

namespace App\DTO;

use Illuminate\Http\UploadedFile;
use Spatie\DataTransferObject\DataTransferObject;

class ProductDTO extends DataTransferObject
{
    public string $name;
    public string $description;
    public float $price;
    public int $quantity;
    public int $category_id;
    public UploadedFile|string $image;
}
