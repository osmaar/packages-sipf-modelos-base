<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class RegistroActividadesRequisitos extends FFV
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'actividades_centro_requisitos';

    public function proceso()
    {
        return $this->belongsTo(Proceso::class);
    }

    public function actividad_id()
    {
        return $this->belongsTo(RegistroActividades::class, "actividad_id", "id");
    }
}
