<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionsHistorico extends Model
{
    use HasFactory;

    protected $table = 'permissions_historico';
    protected $fillable = ['id', 'solicitud_id', 'user_id', 'permission_id'];
}
