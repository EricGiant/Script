<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Artical extends Model
{
    protected $fillable = ["author_id", "title", "content", "isPremium", "image"];

    public function categories(): BelongsToMany
    {
        return $this -> belongsToMany(Category::class, "artical_category_junctions");
    }

    public function author(): BelongsTo
    {
        return $this -> BelongsTo(User::class);
    }

    public function comments(): HasMany
    {
        return $this -> hasMany(Comment::class);
    }
}
