<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        "book_id",
        "content"
    ];

    use HasFactory;

    // TODO: book / author relation(s) toevoegen
}
