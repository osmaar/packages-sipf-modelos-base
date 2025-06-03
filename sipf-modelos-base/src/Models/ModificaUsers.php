<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Model;

class ModificaUsers extends Model
{
  protected $table = 'modifica_users';
  protected $fillable =
  [
    'id',
    'solicitud_id',
    'user_id',
    'nombre',
    'ap1',
    'ap2',
    'c_empleado',
    'puesto',
    'area',
    'email_envio',
    'rol_name',
    'permisos',
    'activo',
  ];

  protected $casts = [
    'permisos' => 'array',
  ];
}
