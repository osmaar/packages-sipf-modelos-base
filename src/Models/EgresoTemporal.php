<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EgresoTemporal extends FFV
{
  use HasFactory;
  use SoftDeletes;

  protected $appends = [
    'transfer_hour',
    'transfer_day'
  ];
  protected $table = 'egresos_temporales';

  protected $fillable = [
    "centro_id",
    "expediente_id",
    "autoridad_ordena",
    "solicitante",
    "circuito",
    "autoridad_judicial",
    "tipo_egreso",
    "centro_destino_id",
    "descripcion_lugar",
    "fecha_egreso",
    "oficio",
    "ruta_oficio",
    "persona_autoriza",
    "cargo_persona_autoriza",
    "observaciones",
    "estatus",
    "readonly"
  ];

  public function autoridadOrdena()
  {
    return $this->flex();
  }

  public function autoridadJudicial()
  {
    return $this->flex();
  }

  public function tipoEgreso()
  {
    return $this->flex();
  }

  public function centroMilitar()
  {
    return $this->flex();
  }

  public function centroDestino()
  {
    return $this->belongsTo(Centro::class, 'centro_destino_id', 'id');
  }

  public function expediente()
  {
    return $this->belongsTo(Expediente::class, 'expediente_id', 'id');
  }

  public function centro()
  {
    return $this->belongsTo(Centro::class, 'centro_id');
  }

  public function autoridad_ordena()
  {
    return $this->flex();
  }

  public function autoridad_judicial()
  {
    return $this->flex();
  }

  public function tipo_egreso()
  {
    return $this->flex();
  }

  public function centro_militar()
  {
    return $this->flex();
  }

  public function centro_destino()
  {
    return $this->belongsTo(Centro::class, 'centro_destino_id', 'id');
  }

  public function scopeActivo($query)
  {
    return $query->whereNotIn('estatus', ['cerrado', 'ingresado']);
  }

  public function scopeUltimo($query)
  {
    return $query->latest('updated_at')->take(1);
  }

  public function getTransferHourAttribute()
  {
    return substr($this->fecha_egreso, 11);
  }

  public function getTransferDayAttribute()
  {
    return substr($this->fecha_egreso, 0, 10);
  }

  public function getEstaFinalizadoAttribute()
  {
    if (in_array($this->estatus, ['cerrado', 'ingresado'])) {
      return true;
    }
    return false;
  }
}
