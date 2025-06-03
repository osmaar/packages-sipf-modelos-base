<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovimientoSolicitud extends Model
{
  use HasFactory;

  protected $table = 'movimientos_solicitudes';

  protected $fillable = [
    'id',
    'name',
    'requiere_notificar',
    'estatus',
  ];

  protected $casts = [
    'requiere_notificar' => 'boolean',
    'created_at' => 'datetime',
    'updated_at' => 'datetime',
  ];
}
