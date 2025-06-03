<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Modificacion extends FFV
{
  use HasFactory;
  use SoftDeletes;

  protected $fillable = [
    'id',
    'proceso_id',
    'fuero',
    'circuito',
    'circuito_estado',
    'autoridad_judicial',
    'autoridad_judicial_otro',
    'fecha_modificacion',
    'num_exp_mod',
    'modificacion_anios',
    'modificacion_meses',
    'modificacion_dias',
    'ruta_oficio',
    'readonly',
    'observacion_modificacion_pena',
    'proceso_pena_anio_original',
    'proceso_pena_mes_original',
    'proceso_pena_dias_original',
    'proceso_pena_reparacion_danio_original',
    'proceso_pena_multa_original'
  ];

  protected $table = 'modificaciones';

  public function autoridad_judicial()
  {
    return $this->flex();
  }

  public function proceso()
  {
    return $this->belongsTo(Proceso::class);
  }

  public function amparos()
  {
    return $this->hasMany(ModificacionAmparo::class);
  }

  public function apelaciones()
  {
    return $this->hasMany(ModificacionApelacion::class);
  }
}
