<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Ingredient extends Model
{
    public function Category(): BelongsTo
    {
        return $this -> belongsTo(Category::class);
    }

    public function Recipes(): BelongsToMany
    {
        return $this -> belongsToMany(Recipe::class);
    }

    use HasFactory;
}