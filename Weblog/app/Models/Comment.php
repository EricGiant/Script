<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    protected $fillable = ["author_id", "content", "artical_id"];

    public function author(): BelongsTo
    {
        return $this -> BelongsTo(User::class);
    }

    public function artical(): BelongsTo
    {
        return $this -> belongsTo(Artical::class);
    }
}