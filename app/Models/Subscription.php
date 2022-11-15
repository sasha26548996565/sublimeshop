<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Subscription extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(): Relation
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
