<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    protected $fillable = [
        "user_id",
        "name",
        "image_path",
        "content",
        "advertised_at"
    ];

    public function bids(): HasMany
    {
        return $this -> hasMany(Bid::class);
    }

    public function user(): BelongsTo
    {
        return $this -> belongsTo(User::class);
    }

    public function categories(): BelongsToMany
    {
        return $this -> belongsToMany(Category::class);
    }

    use HasFactory;
}
