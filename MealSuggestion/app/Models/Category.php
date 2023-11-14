<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    public function ingredients(): HasMany
    {
        return $this->hasMany(Ingredient::class);
    }
    use HasFactory;
}
