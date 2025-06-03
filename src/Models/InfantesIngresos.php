<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class InfantesIngresos extends FFV
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'infantes_ingresos';
    protected $guarded = [];


    public function proceso()
    {
        return $this->belongsTo(Proceso::class);
    }

    public function actividades()
    {
        return $this->hasOne(RegistroActividades::class, "id", "actividad_id");
    }
}
