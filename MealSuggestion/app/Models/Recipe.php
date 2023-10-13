<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Recipe extends Model
{
    public function Ingredients():BelongsToMany
    {
        return $this -> belongsToMany(Ingredient::class);
    }

    use HasFactory;
}
