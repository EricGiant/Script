<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class artical_category_junction extends Model
{
    protected $fillable = ["category_id", "artical_id"];
}
