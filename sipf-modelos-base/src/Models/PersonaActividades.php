<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonaActividades extends FFV
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'persona_actividades';


    public function persona()
    {
        return $this->belongsTo(Persona::class, 'persona_id', 'id');
    }

    public function actividades()
    {
        return $this->hasOne(RegistroActividades::class, "id", "actividad_id");
    }
}
