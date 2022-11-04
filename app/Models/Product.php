<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category(): Relation
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($product) {
            $product->slug = Str::slug($product->name) . now()->format('YmdHis');
        });
    }

    public function isStock(): bool
    {
        return $this->quantity > 0;
    }

    public function getPriceForCount(): float
    {
        return $this->price * $this->pivot->count;
    }
}
