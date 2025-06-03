<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Model;

class UserCentros extends Model
{
    protected $table = 'user_centros';
    protected $fillable = ['id', 'user_id', 'c_empleado', 'centro_id'];
}
