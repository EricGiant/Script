<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grocery extends Model
{
    protected $fillable = ["name", "price", "amount", "category_id"];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
