<?php

namespace Sipf\ModelosBase\Models\Tecnico\Seguridad\Resguardo;

use Sipf\ModelosBase\Models\FFV;
use Illuminate\Database\Eloquent\SoftDeletes;
use Sipf\ModelosBase\Models\CatalogosFlexFields\Pais;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ResguardoDinero extends FFV
{
  use HasFactory;
  use SoftDeletes;

  protected $table = "resguardo_dinero";
  protected $fillable = [
    "id",
    "resguardo_pertenencia_objeto_id",
    "pais_id",
    "tipo_dinero",
    "valor_dinero",
    "otro_valor",
    "cantidad",
    "autoriza",
    "subtotal"
  ];

  public function resguardoPertenenciaObjeto()
  {
    return $this->belongsTo(ResguardoPertenenciaObjeto::class, "resguardo_pertenencia_objeto_id", "id");
  }

  public function pais()
  {
    return $this->belongsTo(Pais::class, "pais_id", "id");
  }

  public function pais_id()
  {
    return $this->flex();
  }
}
