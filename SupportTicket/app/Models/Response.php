<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Response extends Model
{
    protected $fillable = [
        "content",
        "ticket_id"
    ];

    public function ticket():BelongsTo
    {
        return $this -> belongsTo(Ticket::class);
    }

    use HasFactory;
}
