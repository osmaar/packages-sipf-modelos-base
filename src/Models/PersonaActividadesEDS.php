<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonaActividadesEDS extends FFV
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'persona_actividades';

    protected $fillable = [
        "id",
        "persona_id",
        "actividad_id",
        "estatus_actividad",
        "estatus_autorizacion",
        "num_sesion_ct",
        "evidencia_autorizacion_ct",
        "motivo_baja"
    ];

    public function estatus_actividad()
    {
        return $this->flex();
    }

    public function estatus_autorizacion()
    {
        return $this->flex();
    }


    public function proceso()
    {
        return $this->belongsTo(Proceso::class);
    }

    public function actividades()
    {
        return $this->hasMany(CentroAutorizadas::class, "id", "actividad_id");
    }
}
