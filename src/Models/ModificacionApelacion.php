<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModificacionApelacion extends FFV
{
  use HasFactory;
  use SoftDeletes;

  protected $fillable = [
    'id',
    'modificacion_id',
    'toca',
    'fecha_apelacion',
    'fecha_resolucion_apelacion',
    'circuito',
    'autoridad_resuelve',
    'sentido_resolucion_apelacion',
    'ruta_apelacion_resolucion',
    'ruta_apelacion',
    'readonly',
    'apelacion_anios',
    'apelacion_meses',
    'apelacion_dias',
    'reparacion_danio',
    'multa',
    'proceso_pena_anio_original',
    'proceso_pena_mes_original',
    'proceso_pena_dias_original',
    'proceso_pena_reparacion_danio_original',
    'proceso_pena_multa_original'
  ];
  protected $table    = 'modificacion_apelaciones';

  public function autoridad_resuelve()
  {
    return $this->flex();
  }

  public function sentido_resolucion_apelacion()
  {
    return $this->flex();
  }

  public function modificacion()
  {
    return $this->belongsTo(Modificacion::class, 'modificacion_id');
  }
}
