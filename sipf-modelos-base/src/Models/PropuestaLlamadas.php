<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropuestaLlamadas extends FFV
{
  use HasFactory;
  use SoftDeletes;

  protected $table    = 'propuesta_llamadas';
  protected $fillable =
  [
    "persona_id",
    "id_persona_familiar",
    "base",
    "servicio",
    "tipo_llamada",
    "estatus_autorizacion",
    "fecha_autorizacion",
    "estatus_persona",
    "num_sesion_ct",
    "evidencia_autorizacion",
    "pais_consulado",
    "tipo_ayuda",
    "otra_ayuda"
  ];

  public function autoridad_judicial()
  {
    return $this->flex();
  }

  public function servicio()
  {
    return $this->flex();
  }

  public function base()
  {
    return $this->flex();
  }

  public function estatus_autorizacion()
  {
    return $this->flex();
  }

  public function estatus_persona()
  {
    return $this->flex();
  }

  public function tipo_llamada()
  {
    return $this->flex();
  }

  public function tipo_ayuda()
  {
    return $this->flex();
  }

  public function persona_id()
  {
    return $this->hasMany(Referencia::class, "id", "id_persona_familiar");
  }

  public function id_persona_familiar()
  {
    return $this->belongsTo(Referencia::class, "id_persona_familiar", "id");
  }

  public function proceso()
  {
    return $this->belongsTo(Proceso::class);
  }
}
