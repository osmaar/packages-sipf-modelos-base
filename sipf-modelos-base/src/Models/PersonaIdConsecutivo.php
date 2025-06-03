<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonaIdConsecutivo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id'
    ];
}
