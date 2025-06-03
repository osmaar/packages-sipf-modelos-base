<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class RegistroLlamadas extends FFV
{
  use HasFactory;
  use SoftDeletes;

  public    $rules    = [
    'fecha_registro'       => 'required|date',
    'llamada_realizada'    => 'required|boolean',
    'motivo'               => 'required|string|max:255',
    'no_intentos'          => 'required|integer',
    'resolucion_beneficio' => 'required|integer',
    'ubicacion'            => 'required|string|max:100',
    'observaciones'        => 'required|string|max:1000',
  ];
  protected $table    = 'registro_llamadas';
  protected $fillable = [
    'id_propuesta_nombre_persona',
    'primer_llamada',
    'llamada_tipo',
    'fecha_registro',
    'llamada_realizada',
    'motivo',
    'no_intentos',
    'ubicacion',
    'hora_inicio',
    'hora_fin',
    'duracion',
    'observaciones'
  ];

  public function motivo()
  {
    return $this->flex();
  }

  public function familiares()
  {
    return $this->hasOne(Referencia::class, "id", "id_propuesta_nombre_persona");
  }
}
