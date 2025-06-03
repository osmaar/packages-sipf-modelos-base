<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProgramacionModuloDetalleDias extends FFV
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'modulos_centro_dias';

    public function proceso()
    {
        return $this->belongsTo(Proceso::class);
    }

    public function modulo_centro_detalle_id()
    {
        return $this->hasMany(ProgramacionModuloDetalle::class, "id", "modulo_centro_detalle_id");
    }

    public function dias()
    {
        return $this->flex();
    }

    public function turno()
    {
        return $this->flex();
    }
}
