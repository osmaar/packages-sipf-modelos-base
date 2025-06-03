<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ResguardoFolio extends Model
{
  use HasFactory;
  use SoftDeletes;

  protected $table = "resguardo_folios";

  protected $fillable = [
    "expediente_id",
    "centro_id",
    "folio_reguardo",
    "tipo_resguardo",
    "folio_correspondencia_id",
    "fecha",
    "hora",
    "responsable",
    "nombre_ppl",
    ############  F I L E S

    "pathFilePertenencias",
    "nameRecepcionFile",
    "nameEntregaFile",
    "nameIncineracionFile",

    ############  E N T R E G A


    "fecha_entrega",
    "hora_entrega",
    "tipo_entrega",
    "parentesco_entrega",
    "nombre_familiar",
    "descripcion_entrega",
    "entrega_a",
    "observaciones_entrega",

    ###########   I N C I N E R A C I O N
    "fecha_incineracion",
    "hora_incineracion",
    "realiza_incineracion",
    "autoriza_incineracion",
    "observaciones_incineracion",
    "close"
  ];
  public $rules = [
    "responsable" => 'required|integer',
    "nombre_ppl" => 'max:150',
    "centro_id" => 'required|integer',
    "folio_reguardo" => 'required|string|max:20',
    "tipo_resguardo" => 'required|integer',
    "fecha"  => 'required|date',
    "hora" => "required|date_format:H:i:s",
    "close" => 'required|integer',

  ];

  public function fullFolio()
  {
    return $this->folio_reguardo . '-';
  }

  public function tipo_resguardo()
  {
    return $this->flex();
  }

  public function expediente()
  {
    return $this->belongsTo(Expediente::class);
  }
  public function resguardoPertenenciasObjetos()
  {
    return $this->hasMany(ResguardoPertenencia::class, 'folio_resguardo_id');
  }
  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function centro()
  {
    return $this->belongsTo(Centro::class, 'centro_id');
  }

  public function correspondencia()
  {
    return $this->belongsTo(RecepcionCorrespondencia::class, 'folio_correspondencia_id');
  }
}
