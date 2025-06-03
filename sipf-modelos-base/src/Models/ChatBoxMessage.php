<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\ChatBoxMessageSent;

class ChatBoxMessage extends Model
{
    use HasFactory;

    protected $dispatchesEvents = [
        'created' => ChatBoxMessageSent::class,
    ];
    protected $fillable = ['user', 'content', 'attachment'];
}
