<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModificacionAmparo extends FFV
{
  use HasFactory;
  use SoftDeletes;

  protected $table = 'modificacion_amparos';

  protected $fillable = [
    'id',
    'modificacion_id',
    'circuito',
    'juzgado',
    'numero_amparo',
    'fecha_amparo',
    'fecha_resolucion_amparo',
    'sentido_resolucion_amparo',
    'ruta_amparo_resolucion',
    'ruta_amparo',
    'readonly',
    'amparo_anios',
    'amparo_meses',
    'amparo_dias',
    'reparacion_danio',
    'multa',
    'proceso_pena_anio_original',
    'proceso_pena_mes_original',
    'proceso_pena_dias_original',
    'proceso_pena_reparacion_danio_original',
    'proceso_pena_multa_original'
  ];

  public function juzgado()
  {
    return $this->flex();
  }

  public function sentido_resolucion_amparo()
  {
    return $this->flex();
  }

  public function modificacion()
  {
    return $this->belongsTo(Modificacion::class, 'modificacion_id');
  }
}
