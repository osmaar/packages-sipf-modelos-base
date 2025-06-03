<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLastAccess extends Model
{
    public $table = 'user_last_access';

    use HasFactory;

    protected $fillable = [
        'id',
        'session',
        'device',
        'ip_address',
        'latitude',
        'longitud',
        'status'
    ];

    public $rules = [
        'id' => 'required|integer',
        'session' => 'string|max:255',
        'device' => 'string|max:255',
        'ip_address' => 'string|max:255',
        'latitude' => 'string|max:255',
        'longitud' => 'string|max:32'
    ];
}
