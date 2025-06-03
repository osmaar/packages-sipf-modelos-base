<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sanciones extends FFV
{
  use HasFactory;
  use SoftDeletes;

  protected $table = "sanciones";

  protected $fillable = [
    "centro_id",
    "incidente_id",
    "expediente_id",
    "folio_sancion",
    "tipo_sancion",
    "descripcion",
    "fecha",
    "nameFile",
    "fecha_hora_inicio_sancion",
    "fecha_hora_fin_sancion",
    "fecha_hora_fin_real_sancion",
    "lugar_aplicacion",
    "atendida"
  ];

  public $rules = [
    "centro_id" => 'required|integer',
    "incidente_id" => 'required|integer',
    "expediente_id" => 'required|integer',
    "folio_sancion" => 'string|max:22',
    "tipo_sancion" => 'required|integer',
    "descripcion" => 'string|max:200',
    "fecha"  => 'required|date',
    "nameFile" => 'string|max:120',
  ];

  public function tipo_sancion()
  {
    return $this->flex();
  }

  public function expediente()
  {
    return $this->belongsTo(Expediente::class);
  }

  public function sanciones()
  {
    return $this->hasMany(Sanciones::class, 'incidente_id');
  }

  public function incidente()
  {
    return $this->belongsTo(Incidente::class, 'incidente_id');
  }

  public function centro()
  {
    return $this->belongsTo(Centro::class, 'centro_id');
  }
}
