<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class BeneficioApelacion extends FFV
{
  use HasFactory;
  use SoftDeletes;

  protected $table = 'beneficios_apelaciones';

  protected $fillable = [
    'id',
    'beneficio_id',
    'toca',
    'fecha_apelacion',
    'fecha_resolucion_apelacion',
    'circuito',
    'autoridad_resuelve',
    'sentido_resolucion_apelacion',
    'ruta_apelacion_resolucion',
    'ruta_apelacion',
    'readonly'
  ];

  public function autoridad_resuelve()
  {
    return $this->flex();
  }

  public function sentido_resolucion_apelacion()
  {
    return $this->flex();
  }

  public function beneficio()
  {
    return $this->belongsTo(Beneficio::class, 'beneficio_id');
  }
}
