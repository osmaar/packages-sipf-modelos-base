<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VisitaExternaDocumento extends Model
{
  use HasFactory;
  use SoftDeletes;

  protected $guarded = [];
  protected $table   = 'visita_externa_documentos';


  public function propuestaVisita()
  {
    return $this->belongsTo(VisitaExterna::class, "visita_externa_id");
  }
}
