<?php

namespace Sipf\ModelosBase\Models\Bitacoras;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Autorizacion extends Model
{

  use HasFactory;

  /**
   * Name of the table
   *
   * @var string
   */
  protected $table = 'bitacora_autorizaciones';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'usuario_solicita',
    'usuario_autoriza',
    'fecha_autorizacion',
    'hora_autorizacion',
    'accion_realizada'
  ];

  protected $casts = [
    'fecha_autorizacion' => 'date',
  ];
}
