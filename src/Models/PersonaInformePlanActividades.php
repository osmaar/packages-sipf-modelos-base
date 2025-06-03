<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonaInformePlanActividades extends FFV
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'persona_informes_plan_actividades';
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
