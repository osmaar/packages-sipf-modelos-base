<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonaIdTemporal extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id'
    ];
}
