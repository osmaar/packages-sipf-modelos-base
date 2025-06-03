<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class RegistroActividades extends FFV
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'actividades_centro';


    public function proceso()
    {
        return $this->belongsTo(Proceso::class);
    }

    public function requisitos()
    {
        return $this->hasMany(RegistroActividadesRequisitos::class, "actividad_id", "id");
    }

    public function dias()
    {
        return $this->hasMany(RegistroActividadesDias::class, "actividad_id", "id");
    }

    public function base()
    {
        return $this->flex();
    }

    public function servicio()
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
}
