<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class CentroAutorizadas extends FFV
{
    use HasFactory;
    use SoftDeletes;

    protected $appends = [
        'duracion',
        'costo_fin',
        'institucion_nombre'
    ];

    protected $table = 'actividades_centro';

    protected $fillable = [
        "centro_id",
        "base",
        "servicio",
        "actividad",
        "temporalidad",
        "duracion_cantidad",
        "duracion_unidad",
        "fecha_inicio",
        "fecha_fin",
        "dias_semana",
        "institucion",
        "nombre_institucion",
        "existe_convenio",
        "tiene_costo",
        "costo",
        "temporalidad_costo",
        "limite_participantes",
        "numero_participantes",
        "tiene_requisitos",
        "estatus_autorizacion",
        "estatus_actividad",
    ];


    public function base()
    {
        return $this->flex();
    }

    public function servicio()
    {
        return $this->flex();
    }

    public function estatus_actividad()
    {
        return $this->flex();
    }

    public function estatus_autorizacion()
    {
        return $this->flex();
    }

    public function institucion()
    {
        return $this->flex();
    }

    public function temporalidad()
    {
        return $this->flex();
    }

    public function duracion_unidad()
    {
        return $this->flex();
    }

    public function temporalidad_costo()
    {
        return $this->flex();
    }

    public function temporalidad_remuneracion()
    {
        return $this->flex();
    }

    public function personas()
    {
        return $this->belongsTo(Persona::class);
    }

    public function getDuracionAttribute()
    {
        self::duracion_unidad();
        return $this->duracion_cantidad;
    }

    public function getCostoFinAttribute()
    {
        if ($this->tiene_costo == 'Si')
            $return = $this->costo;
        else
            $return = 'N/A';
        return $return;
    }

    public function getInstitucionNombreAttribute()
    {
        if ($this->nombre_institucion == null || $this->nombre_institucion == '')
            $return = 'N/A';
        else
            $return = $this->nombre_institucion;
        return $return;
    }
}
