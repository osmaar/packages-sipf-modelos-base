<?php

namespace Sipf\ModelosBase\Models\Catalogos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CtgEstatusPropuestaEgresoInfante extends Model
{
  use HasFactory, SoftDeletes;

  protected $table = 'ctg_estatus_propuesta_egreso_infantes';

  protected $fillable = [
    'id',
    'descripcion',
    'orden'
  ];
}
