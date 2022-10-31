<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category(): Relation
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
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
