<?php

namespace Sipf\ModelosBase\Models\DireccionGeneral\Correspondencia;

use Sipf\ModelosBase\Models\FFV;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Sipf\ModelosBase\Models\CatalogosFlexFields\Pais;
use Sipf\ModelosBase\Models\Tecnico\Seguridad\Resguardo\ResguardoPertenenciaObjeto;

class RecepcionCorrespondenciaObjetoDinero extends FFV
{
  use HasFactory;
  use SoftDeletes;

  protected $table = "recepcion_correspondencia_objetos_dinero";
  protected $fillable = [
    "id",
    "recepcion_correspondencia_objeto_id",
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
