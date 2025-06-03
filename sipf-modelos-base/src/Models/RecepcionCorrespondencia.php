<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class RecepcionCorrespondencia extends FFV
{
  use HasFactory;
  use SoftDeletes;

  public    $rules    = [

    'fecha_entrega'                 => 'date_format:Y-m-d',
    'fecha_recepcion'               => 'date_format:Y-m-d|required',
    'folio'                         => 'required',
    'formato_entrega_recepcion_ppl' => 'string|max:200',
    'paqueteria_procedencia'        => 'integer|required',
    'peso_correspondencia'          => 'numeric|required',
    'tipo_correspondencia'          => 'integer|required',
  ];
  protected $table    = 'recepcion_correspondencia';
  protected $fillable = [
    'id',
    'persona_id',
    'remitente_id',
    'folio',
    'fecha_recepcion',
    'hora',
    'tipo_correspondencia',
    'descripcion',
    'no_guia',
    'empresa_mensajeria',
    'peso_correspondencia',
    'estatus_correspondencia',
    'rechazo_correspondencia',
    'motivo_rechazo',
    'entregado',
    'motivo_no_entrega',
    'fecha_entrega',
    'formato_entrega_recepcion_ppl',
    'observaciones',
    'fecha_rechazo',
  ];

  public function tipo_correspondencia()
  {
    return $this->flex();
  }

  public function empresa_mensajeria()
  {
    return $this->flex();
  }

  public function estatus_correspondencia()
  {
    return $this->flex();
  }

  public function motivo_rechazo()
  {
    return $this->flex();
  }

  public function persona()
  {
    return $this->belongsTo(Persona::class, "persona_id", "id");
  }

  public function remitente_id()
  {
    return $this->belongsTo(Referencia::class, "remitente_id", "id");
  }

  public function scopeResguardada($query)
  {
    return $query->where("estatus_correspondencia", "=", "Resguardado");
  }
}
