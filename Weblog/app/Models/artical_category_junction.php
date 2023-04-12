<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// TODO: maak nooit models voor junction tables! (maar werk via relaties vanaf de parents)
class artical_category_junction extends Model
{
    protected $fillable = ["category_id", "artical_id"];
}
