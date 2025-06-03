<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProgramacionModuloDetalle extends FFV
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'modulos_centro_detalle';

    public function proceso()
    {
        return $this->belongsTo(Proceso::class);
    }

    public function modulo_centro_id()
    {
        return $this->belongsTo(ProgramacionModulo::class, "modulo_centro_id", "id");
    }

    public function dias()
    {
        return $this->belongsTo(ProgramacionModuloDetalleDias::class, "id", "modulo_centro_detalle_id");
    }

    public function dias_semana()
    {
        return $this->flex();
    }

    public function turnos()
    {
        return $this->flex();
    }

    public function modulos()
    {
        return $this->belongsTo(Ubicaciones\CentroModulo::class, "modulos", "id");
    }
}
