<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        "author_id",
        "name",
        "image_path"
    ];

    use HasFactory;

    // TODO: autor relation toevoegen
}
