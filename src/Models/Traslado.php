<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Traslado extends FFV
{
  use HasFactory;
  use SoftDeletes;

  protected $table = "traslados";
  protected $fillable = [
    "centro_id",
    "expediente_id",
    "autoridad_ordena",
    "autoridad_judicial",
    "tipo_traslado",
    "estado",
    "centro_destino_id",
    "centro_estatal",
    "centro_militar",
    "centro_destino",
    "fecha_traslado",
    "oficio",
    "ruta_oficio",
    "persona_autoriza",
    "cargo_persona_autoriza",
    "observaciones",
    "esta_transitando",
    "lugar_transito",
    "inicio_transito",
    "fin_transito",
    "expediente_transito",
    "estatus",
    "pais",
    "readonly",
    "circuito"
  ];

  /**
   *Relaciones Eloquent
   */

  public function centro()
  {
    return $this->belongsTo(Centro::class, 'centro_id');
  }

  public function estado()
  {
    return $this->hasOne(SepomexEstado::class, 'c_estado', 'procedencia_estado')
      ->select(['c_estado', 'd_estado']);
  }

  public function pais()
  {
    return $this->flex();
  }

  public function expediente()
  {
    return $this->belongsTo(Expediente::class);
  }

  public function centroDestino()
  {
    return $this->belongsTo(Centro::class);
  }

  public function centroEstatal()
  {
    return $this->flex();
  }

  public function centroMilitar()
  {
    return $this->flex();
  }

  public function autoridadOrdena()
  {
    return $this->flex();
  }

  public function autoridadJudicial()
  {
    return $this->flex();
  }

  public function tipoTraslado()
  {
    return $this->flex();
  }

  public function centro_destino()
  {
    return $this->belongsTo(Centro::class);
  }

  public function centro_estatal()
  {
    return $this->flex();
  }

  public function centro_militar()
  {
    return $this->flex();
  }

  public function autoridad_ordena()
  {
    return $this->flex();
  }

  public function autoridad_judicial()
  {
    return $this->flex();
  }

  public function tipo_traslado()
  {
    return $this->flex();
  }

  public function scopeActivo($query)
  {
    return $query->whereNotIn('estatus', ['cerrado', 'ingresado']);
  }

  public function scopeUltimo($query)
  {
    return $query->latest('updated_at')->take(1);
  }

  /**
   *Atributos
   */

  public function getEstaFinalizadoAttribute()
  {
    if (in_array($this->estatus, ['cerrado', 'ingresado'])) {
      return true;
    }
    return false;
  }
}
