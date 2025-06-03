<?php

namespace Sipf\ModelosBase\Models\Tecnico\TrabajoSocial\Infantes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InfantePropuestaInfante extends Model
{
  use HasFactory, SoftDeletes;

  protected $table = "propuesta_referencias_egreso_infantes";
  protected $fillable = [
    "propuesta_id",
    "infante_id",
  ];

  public function propuestaEgresoReferencia()
  {
    return $this->belongsTo(
      InfantePropuesta::class,
      "propuesta_id",
      "id"
    );
  }

  public function infante()
  {
    return $this->belongsTo(Infante::class);
  }
}
