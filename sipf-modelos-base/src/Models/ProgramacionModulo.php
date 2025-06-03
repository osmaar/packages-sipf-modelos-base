<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProgramacionModulo extends FFV
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'modulos_centro';


    public function proceso()
    {
        return $this->belongsTo(Proceso::class);
    }

    public function detalles()
    {
        return $this->hasMany(ProgramacionModuloDetalle::class, "modulo_centro_id", "id");
    }

    public function dias()
    {
        return $this->hasMany(ProgramacionModuloDetalleDias::class, "modulo_centro_detalle_id", "id");
    }

    public function dias_semana()
    {
        return $this->flex();
    }

    public function base()
    {
        return $this->flex();
    }

    public function servicio()
    {
        return $this->flex();
    }
    public function actividad_centro()
    {
        return $this->belongsTo(RegistroActividades::class, "actividad_centro", "id");
    }
}
