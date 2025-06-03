<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class ResguardoPertenencia extends Flexfield
{
  use HasFactory;
  use SoftDeletes;

  protected $table = "resguardo_pertenencias_objetos";
  protected $fillable = [
    "folio_resguardo_id",
    "tipo_objeto",
    "descripcion_objeto",
    "estado_resguardo",
    "valor_objeto",
    "observaciones",
    "estatus",
    "disabled",
    "fecha_resguardo",
    "hora_resguardo",
  ];


  public $rules = [
    "folio_resguardo_id" => 'required|integer',
    "tipo_objeto" => 'required|integer',
    "descripcion_objeto" => 'required|string|max:500',
    "estado_resguardo" => 'required|integer',
    "valor_objeto" => 'required|integer',
    "fecha_resguardo"  => 'required|date',
    "hora_resguardo" => "required|date_format:H:i:s",
  ];


  public function catalogos()
  {
    return $this->hasMany(ResguardoPertenencia::class, 'folio_resguardo_id');
  }

  public function customRelation()
  {
    return $this->hasMany(FlexfieldValue::class, "flexfield_id", "code");
  }

  public function folios()
  {
    return $this->hasMany(ResguardoFolio::class, 'id', 'folio_resguardo_id');
  }
  public function entregaIncineracion()
  {
    return $this->hasMany(ResguardoEntregaIncineracion::class, 'id', 'ei_id');
  }

  public function dinero()
  {
    return $this->hasMany(ResguardoDinero::class, 'resguardo_id', 'id');
  }

  public function idGroup()
  {
    return $this->belongsTo(ResguardoEntregaIncineracion::class, 'group_id', 'idGroup');
  }

  public function entregaIncineracion02()
  {
    return $this->belongsTo(ResguardoEntregaIncineracion::class, 'folio_resguardo_id', 'folio_resguardo_id')
      ->whereColumn('resguardo_pertenencias_objetos.idGroup', '=', 'resguardo_pertenencias_e_i.group_id');
  }
}
