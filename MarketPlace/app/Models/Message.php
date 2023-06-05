<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use function PHPSTORM_META\map;

class Message extends Model
{
    protected $fillable = [
        "chat_id",
        "sender_id",
        "content"
    ];

    public function sender(): BelongsTo
    {
        return $this -> belongsTo(User::class);
    }

    use HasFactory;
}
