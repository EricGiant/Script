<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    protected $fillable = ["name"];

    public function articals(): BelongsToMany
    {
        return $this -> belongsToMany(Artical::class, "artical_category_junctions");
    }
}