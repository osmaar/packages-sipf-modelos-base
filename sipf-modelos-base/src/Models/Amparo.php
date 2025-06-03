<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Amparo extends FFV
{
  use HasFactory;
  use SoftDeletes;

  protected $table = 'amparos';

  protected $fillable = [
    'proceso_id',
    'numero_amparo',
    'circuito',
    'autoridad_resuelve',
    'fecha_amparo',
    'observacion_presenta_amparo_sentencia',
    'sentido_resolucion_amparo',
    'amparo_anios',
    'amparo_meses',
    'amparo_dias',
    'fecha_resolucion',
    'observacion_resolucion_amparo_sentencia',
    'reparacion_danio',
    'multa',
    'ruta_amparo',
    'ruta_amparo_resolucion',
    'readonly',
    'sentencia_primera_anios_original',
    'sentencia_primera_meses_original',
    'sentencia_primera_dias_original',
    'sentencia_reparacion_danio_original',
    'sentencia_multa_original'
  ];

  public $rules = [
    'proceso_id' => 'required|integer',
    'numero_amparo' => 'required|max:50|string',
    'autoridad_resuelve' => 'required|integer',
    'sentido_resolucion_amparo' => 'required|integer',
    'amparo_anios' => 'required',
    'amparo_meses' => 'required',
    'amparo_dias' => 'required',
    'fecha_resolucion' => 'required|date',
    'reparacion_danio' => 'max:50|string',
    'multa' => 'max:300|string'
  ];

  public function autoridad_resuelve()
  {
    return $this->flex();
  }

  public function sentido_resolucion_amparo()
  {
    return $this->flex();
  }

  public function proceso()
  {
    return $this->belongsTo(Proceso::class);
  }
}
