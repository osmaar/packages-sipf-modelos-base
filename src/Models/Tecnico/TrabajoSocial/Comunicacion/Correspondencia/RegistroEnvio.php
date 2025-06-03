<?php

namespace Sipf\ModelosBase\Models\Tecnico\TrabajoSocial\Comunicacion\Correspondencia;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RegistroEnvio extends Model
{
  use HasFactory;
  use SoftDeletes;

  protected $table = 'registros_envio';

  protected $fillable = [
    'id',
    'solicitud_envio_id',
    'folio',
    'fecha_hora',
    'numero_guia',
    'pais_id',
    'estado_id',
    'municipio_id',
    'calle',
    'numero_exterior',
    'colonia',
    'codigo_postal',
    'codigo_pais',
    'telefono',
    'empresa_mensajeria',
    'fecha_cancelacion',
    'responsable',
    'estatus',
    'observaciones'
  ];
}
