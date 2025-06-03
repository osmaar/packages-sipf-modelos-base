<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class VisitaFamiliarDocumento extends FFV
{
  use HasFactory;
  use SoftDeletes;

  protected $guarded = [];
  protected $table   = 'visita_familiares_documentos';


  public function propuestaVisita()
  {
    return $this->belongsTo(VisitaFamiliar::class, "visita_familiar_id");
  }
}
