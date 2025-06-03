<?php

namespace Sipf\ModelosBase\Models\Tecnico\Seguridad\PaseDeLista;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReglaDeAsignacionSeccion extends Model
{
  use HasFactory, SoftDeletes;

  protected $table = 'regla_de_asignacion_seccion';

  protected $fillable = [
    'regla_de_asignacion_id',
    'seccion_id',
  ];

  /**
   * Casteo de datos
   *
   * @var array
   */
  protected $casts = [
    'deleted_at' => 'datetime',
    'created_at' => 'datetime',
    'updated_at' => 'datetime',
  ];
}
