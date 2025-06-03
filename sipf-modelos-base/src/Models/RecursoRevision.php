<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class RecursoRevision extends FFV
{
  use HasFactory;
  use SoftDeletes;

  protected $table = 'recurso_revision';

  protected $fillable = [
    'proceso_id',
    'numero_recurso_revision',
    'circuito',
    'autoridad_resuelve',
    'fecha_recurso',
    'observacion_presenta_recurso_revision',
    'sentido_resolucion_recurso',
    'recurso_revision_anios',
    'recurso_revision_meses',
    'recurso_revision_dias',
    'fecha_resolucion',
    'observacion_resolucion_recurso_sevision',
    'reparacion_danio',
    'multa',
    'ruta_recurso_revision',
    'ruta_recurso_revision_resolucion',
    'readonly',
    'amparo_anio_original',
    'amparo_mes_original',
    'amparo_dias_original',
    'amparo_reparacion_danio_original',
    'amparo_multa_original',
    'amparo_sentido_resolucion_original',
    'amparo_fecha_resolucion_original',
    'amparo_observacion_resolucion_original',
    'amparo_ruta_resolucion_original',
    'meta_data',
    'amparo_sentencia_absolutoria_original',
    'sentencia_absolutoria',
    'amparo_id',
    'numero_amparo_original',
    'fecha_amparo_original',
  ];

  public $rules = [
    'proceso_id' => 'required|integer',
    'numero_recurso_revision' => 'required|max:50|string',
    'autoridad_resuelve' => 'required|integer',
    'sentido_resolucion_recurso' => 'required|integer',
    'recurso_revision_anios' => 'required',
    'recurso_revision_meses' => 'required',
    'recurso_revision_dias' => 'required',
    'fecha_resolucion' => 'required|date',
    'reparacion_danio' => 'max:50|string',
    'multa' => 'max:300|string'
  ];

  public function autoridad_resuelve()
  {
    return $this->flex();
  }

  public function sentido_resolucion_recurso()
  {
    return $this->flex();
  }

  public function proceso()
  {
    return $this->belongsTo(Proceso::class);
  }
}
