<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VisitasExternas extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'visitas_externas';

    protected $fillable = [
        'tipo_registro',
        'nombre',
        'primer_apellido',
        'segundo_apellido',
        'tipo_programacion',
        'tipo_visita',
        'otra_ppl_visita',
        'marca_vehiculo',
        'persona_autorizada',
        'dias_visita',
        'turno',
        'hora_inicio',
        'hora_fin',
        'ubicacion',
        'file_solicitud_formato',
        'documento_autorizacion',
        'autorizacion_visita',
        'observaciones',
        'estatus_visita',
    ];
}
