<?php

namespace Sipf\ModelosBase\Models\Tecnico\TrabajoSocial\Infantes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InfantePropuestaResolucionReferecias extends Model
{
  use HasFactory, SoftDeletes;

  protected $table = "propuesta_egreso_resoluciones_referencias";
  protected $fillable = [
    "propuesta_id",
    "resolucion_id",
  ];

  /**
   *Relaciones Eloquent
   */
  public function propuestaResolucion()
  {
    return $this->belongsTo(InfantePropuestaResolucion::class, "resolucion_id", "id");
  }

  public function propuestaReferencia()
  {
    return $this->belongsTo(InfantePropuesta::class, "propuesta_id", "id");
  }
}
