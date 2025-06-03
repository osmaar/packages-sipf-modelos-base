<?php

namespace Sipf\ModelosBase\Models\Tecnico\TrabajoSocial\Comunicacion\Correspondencia;

use Sipf\ModelosBase\Models\Persona;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SolicitudEnvio extends Model
{
  use HasFactory;
  use SoftDeletes;

  protected $table = 'solicitudes_envio';

  protected $fillable = [
    'id',
    'persona_id',
    'referencia_id',
    'destinatario_nombre',
    'destinatario_primer_apellido',
    'destinatario_segundo_apellido',
    'parentesco',
    'tipo_correspondencia',
    'numero_guia',
    'fecha_registro',
    'empresa_mensajeria',
    'fecha_cancelacion',
    'recibio',
    'estatus',
    'observaciones'

  ];

  public function persona()
  {
    return $this->belongsTo(Persona::class, 'persona_id', 'id');
  }

  public function scopePorPersona($query, $persona_id)
  {
    return $query->where('persona_id', '=', $persona_id);
  }

  public function getFechaRegistroFormatAttribute()
  {
    $date = date_create($this->fecha_registro);
    return date_format($date, 'd/m/Y');
  }
}
