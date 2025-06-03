<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EgresoLibertad extends Model
{
  use HasFactory;
  use SoftDeletes;

  protected $table = 'egresos_libertades';

  protected $fillable = [
    'id',
    'expediente_id',
    'fecha_hora_egreso',
    'persona_autoriza',
    'persona_autoriza_cargo',
    'soporte_file',
    'soporte_file_nombre',
    'observaciones',
    'usuario_registro',
  ];

  public function scopeVigente($query, $fecha_ingreso)
  {
    return $query->where("created_at", ">=", $fecha_ingreso);
  }
}
