<?php

namespace Sipf\ModelosBase\Models\Tecnico\Seguridad\Sanciones;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Sipf\ModelosBase\Models\Tecnico\Seguridad\Incidentes\IncidenteInvolucrado;

class SancionInvolucrado extends Model
{
  use HasFactory;
  use SoftDeletes;

  protected $table = "sanciones_involucrados";

  protected $fillable = [
    "sancion_id",
    "incidente_involucrados_id",
    "incidente_id",
  ];

  public function sancion()
  {
    return $this->belongsTo(Sancion::class);
  }

  public function involucradoIncidente()
  {
    return $this->belongsTo(IncidenteInvolucrado::class, 'incidente_involucrados_id', 'id');
  }

  public function scopePorSancion($query, $sancion_id)
  {
    return $query->where("sancion_id", "=", $sancion_id);
  }
}
