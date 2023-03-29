<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Artical extends Model
{
    protected $fillable = ["author_id", "title", "content"];

    public function categories(): BelongsToMany
    {
        return $this -> belongsToMany(Category::class, "artical_category_junctions");
    }

    public function author(): BelongsTo
    {
        return $this -> BelongsTo(User::class);
    }
}
