<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class VisitasBitacora extends FFV
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'visitas_bitacora';

    public function tipo_visita()
    {
        return $this->flex();
    }

    public function motivo_no_ingreso()
    {
        return $this->flex();
    }

    public function tipo_identificacion()
    {
        return $this->flex();
    }

    public function tipo_acceso()
    {
        return $this->flex();
    }

    public function expediente()
    {
        return $this->belongsTo(Expediente::class);
    }

    public function personas()
    {
        return $this->belongsTo(Persona::class);
    }
}
