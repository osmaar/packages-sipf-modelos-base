<?php

namespace Sipf\ModelosBase\Models\Tecnico\Seguridad\Incidentes;

use Sipf\ModelosBase\Models\Persona;
use Illuminate\Database\Eloquent\Model;
use Sipf\ModelosBase\Models\Referencia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Sipf\ModelosBase\Models\Catalogos\CtgTipoInvolucrado;
use Sipf\ModelosBase\Models\Catalogos\CtgTipoParticipacion;
use Sipf\ModelosBase\Models\Tecnico\Seguridad\Sanciones\SancionInvolucrado;

class IncidenteInvolucrado extends Model
{
  use HasFactory, SoftDeletes;

  protected $table = 'incidentes_involucrados';

  protected $fillable = [
    'incidente_id',
    'persona_id',
    'referencia_id',
    'identificador',
    'nombre',
    'primer_apellido',
    'segundo_apellido',
    'nombre_completo',
    'es_ppl_sesion',
    'ubicacion',
  ];

  public $rules = [];


  /**
   *Relaciones Eloquent
   */
  public function tipoParticipacion()
  {
    return $this->belongsTo(CtgTipoParticipacion::class);
  }

  public function tipoInvolucrado()
  {
    return $this->belongsTo(CtgTipoInvolucrado::class);
  }

  public function incidente()
  {
    return $this->belongsTo(Incidente::class);
  }

  public function referencia()
  {
    return $this->belongsTo(Referencia::class);
  }

  public function persona()
  {
    return $this->belongsTo(Persona::class);
  }

  public function sancionesInvolucrado()
  {
    return $this->hasMany(SancionInvolucrado::class, "incidente_involucrados_id", "id");
  }

  /**
   *Scopes
   */
  public function scopePorIncidente($query, $incidente_id)
  {
    return $query->where("incidente_id", "=", $incidente_id);
  }

  public function scopePplSesion($query)
  {
    return $query->where("es_ppl_sesion", "=", 1);
  }
}
