<?php

namespace Sipf\ModelosBase\Models;

use App\Models\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class VisitaExterna extends FFV
{
  use HasFactory;
  use SoftDeletes, Searchable;

  public    $camposBusqueda = ['nombre', 'primer_apellido', 'segundo_apellido'];
  protected $casts          = ['fecha_propuesta' => 'date'];
  protected $guarded        = [];
  protected $table          = 'visita_externas';

  public function ppls()
  {
    return $this->belongsToMany(
      Persona::class,
      VisitaExternaPPL::class,
      'visita_externa_id',
      'persona_id',
      'id',
      'id'
    );
  }

  public function estatus_autorizacion()
  {
    return $this->flex();
  }

  public function estatus_persona()
  {
    return $this->flex();
  }

  public function personaPropuesta()
  {
    return $this->belongsTo(Referencia::class, "referencia_id");
  }

  public function visitas()
  {
    return $this->morphToMany(VisitaAcceso::class, 'visita');
  }

  public function visitasExternasPPL()
  {
    return $this->hasMany(VisitaExternaPPL::class, "visita_externa_id");
  }

  public function scopeAutorizada($query)
  {
    return $query->where("estatus_autorizacion", "=", "2043");
  }

  public function documentos()
  {
    return $this->hasMany(VisitaExternaDocumento::class, 'visita_externa_id');
  }
}
