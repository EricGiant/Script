<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bid extends Model
{
    protected $fillable = [
        "user_id",
        "post_id",
        "amount",
    ];

    public function user(): BelongsTo
    {
        return $this -> belongsTo(User::class);
    }

    use HasFactory;
}
