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
        "user_id",
        "appointed_to_id",
        "status_id"
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

    public function status():belongsTo
    {
        return $this -> belongsTo(Status::class);
    }

    public function appointed_to_user():BelongsTo
    {
        return $this -> belongsTo(User::class, "appointed_to_id");
    }

    use HasFactory;
}
