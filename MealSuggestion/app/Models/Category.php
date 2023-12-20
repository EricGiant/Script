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

    // TODO: traits bij  voorkeur bovenaan class definition plaatsen, gevolgd door relations
    // (probeer consistent met volgorde te zijn tussen verschillende classes)
    use HasFactory;
}
