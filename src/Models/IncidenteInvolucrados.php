<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class IncidenteInvolucrados extends FFV
{
  use HasFactory;
  use SoftDeletes;

  protected $table = 'incidente_involucrados';

  public function incidente()
  {
    return $this->belongsTo(Incidente::class);
  }

  public function incidencia()
  {
    return $this->belongsTo(Incidente::class, 'incidente_id', 'id');
  }
  public function tipo_involucrado()
  {
    return $this->flex();
  }

  public function participacion()
  {
    return $this->flex();
  }
}
