<?php

namespace Sipf\ModelosBase\Models\DireccionGeneral\Correspondencia;

use Sipf\ModelosBase\Models\Centro;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EnviosCorrespondencia extends Model
{
  use HasFactory;

  protected $table = "envio_correspondencia";
  protected $primaryKey = "id";

  protected $guarded = [];

  public function familiar_correspondencia()
  {
    return $this->belongsTo(FamiliarCorrespondencia::class, 'familiar_id', 'id');
  }

  /**
   *Otros Métodos
   */

  public static function calcularFolio($centro_id, $anio, $consecutivo)
  {
    $centro = Centro::find($centro_id);
    $codigo_centro = "C" . sprintf("%02d", $centro->numero);
    return "CE-" . $codigo_centro . "-" . sprintf("%04d", $consecutivo) . "/" . $anio;
  }

  public static function calcularConsecutivo($centro_id, $anio)
  {
    $consecutivo = 1;
    $ultimo = EnviosCorrespondencia::where("centro_id", "=", $centro_id)
      ->whereYear("fecha", $anio)
      ->select("consecutivo")
      ->orderBy('consecutivo', 'DESC')->first();
    if ($ultimo) {
      $ultimo_consecutivo = $ultimo->consecutivo;
      $consecutivo = intval($ultimo_consecutivo) + 1;
    }
    return $consecutivo;
  }
}
