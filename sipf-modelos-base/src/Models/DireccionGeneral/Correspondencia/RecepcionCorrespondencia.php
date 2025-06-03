<?php

namespace Sipf\ModelosBase\Models\DireccionGeneral\Correspondencia;

use Sipf\ModelosBase\Models\Centro;
use Sipf\ModelosBase\Models\Persona;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RecepcionCorrespondencia extends Model
{
  use HasFactory;
  use SoftDeletes;

  protected $table = "recepcion_correspondencia";
  protected $primaryKey = "id";

  protected $guarded = [];

  public function persona()
  {
    return $this->belongsTo(Persona::class, "persona_id");
  }

  public function scopeResguardada($query)
  {
    return $query->where("estatus_correspondencia", "=", "Resguardado");
  }

  public static function calcularFolio($centro_id, $anio, $consecutivo)
  {
    $centro = Centro::find($centro_id);
    $codigo_centro = "C" . sprintf("%02d", $centro->numero);
    return "CR-" . $codigo_centro . "-" . sprintf("%04d", $consecutivo) . "/" . $anio;
  }

  public static function calcularConsecutivo($centro_id, $anio)
  {
    $consecutivo = 1;
    $ultimo = RecepcionCorrespondencia::where("centro_id", "=", $centro_id)
      ->whereYear("fecha_recepcion", $anio)
      ->select("consecutivo")
      ->orderBy('consecutivo', 'DESC')->first();
    if ($ultimo) {
      $ultimo_consecutivo = $ultimo->consecutivo;
      $consecutivo = intval($ultimo_consecutivo) + 1;
    }
    return $consecutivo;
  }
}
