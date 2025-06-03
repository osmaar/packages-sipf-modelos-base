<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class SendCorrespondence extends FFV
{
  use HasFactory;
  use SoftDeletes;

  protected $table    = 'envio_correspondencia';
  protected $fillable = [
    "persona_id",
    "familiar_id",
    "folio",
    "fecha",
    "hora",
    "tipo",
    "numero_guia",
    "observaciones",
    "estatus_correspondencia",
    "fecha_envio",
    "motivo_rechazo",
    "fecha_rechazo",
    "fecha_envio",
    "empresa_mensajeria",
    "persona_recibe",
    "otro",
    "otra_empresa"
  ];

  public function personaFamiliares()
  {
    return $this->belongsTo(Referencia::class, "familiar_id", "id");
  }

  public function tipo_correspondencia()
  {
    return $this->flex();
  }

  public function estatus_correspondencia()
  {
    return $this->flex();
  }

  public function empresa_mensajeria()
  {
    return $this->flex();
  }
}
