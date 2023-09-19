<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Ticket extends Model
{
    protected $fillable = [
        "title",
        "content",
        "user_id"
    ];

    public function user():BelongsTo
    {
        return $this -> belongsTo(User::class);
    }

    public function categories():BelongsToMany
    {
        return $this -> belongsToMany(Category::class);
    }

    public function responses():HasMany
    {
        return $this -> hasMany(Response::class);
    }

    public function status():HasOne
    {
        return $this -> hasOne(Status::class);
    }

    use HasFactory;
}
