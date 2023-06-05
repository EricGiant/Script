<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    protected $fillable = [
        "user_id",
        "name",
        "image_path",
        "content",
        "premium_order",
    ];

    public function bids(): HasMany
    {
        return $this -> hasMany(Bid::class);
    }

    public function user(): BelongsTo
    {
        return $this -> belongsTo(User::class);
    }

    use HasFactory;
}
