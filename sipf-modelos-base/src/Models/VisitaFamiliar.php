<?php

namespace Sipf\ModelosBase\Models;

use App\Models\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class VisitaFamiliar extends FFV
{
  use HasFactory;
  use SoftDeletes, Searchable;

  public    $camposBusqueda = ['nombre', 'primer_apellido', 'segundo_apellido'];
  protected $guarded        = [];
  protected $table          = 'visita_familiares';

  public function estatus_autorizacion()
  {
    return $this->flex();
  }

  public function estatus_persona()
  {
    return $this->flex();
  }

  public function tipo_visita_2()
  {
    return $this->flex();
  }

  public function personaPropuesta()
  {
    return $this->belongsTo(Referencia::class, "referencia_id");
  }

  public function documentos()
  {
    return $this->hasMany(VisitaFamiliarDocumento::class, 'visita_familiar_id');
  }

  public function credencial()
  {
    return $this->hasOne(VisitaFamiliarCredencial::class, 'visita_familiar_id');
  }

  public function visitas()
  {
    return $this->morphToMany(VisitaAcceso::class, 'visita');
  }

  public function tutorUno()
  {
    return $this->belongsTo(Referencia::class, 'tutor_uno')
      ->select(
        'id',
        DB::raw(
          "concat(nombre,' ',primer_apellido,' ',coalesce(segundo_apellido,'')) as 'nombre'"
        ),
      );
  }

  public function tutorDos()
  {
    return $this->belongsTo(Referencia::class, 'tutor_dos')
      ->select(
        'id',
        DB::raw(
          "concat(nombre,' ',primer_apellido,' ',coalesce(segundo_apellido,'')) as 'nombre'"
        ),
      );
  }

  public function scopeAutorizada($query)
  {
    return $query->where("estatus_autorizacion", "=", "2043");
  }
}
