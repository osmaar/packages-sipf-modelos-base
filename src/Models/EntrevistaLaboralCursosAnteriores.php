<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class EntrevistaLaboralCursosAnteriores extends FFV
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'entrevista_laboral_cursos_anteriores';

    public function proceso()
    {
        return $this->belongsTo(Proceso::class);
    }

    public function entrevista_id()
    {
        return $this->belongsTo(PersonaEntrevistaLaboral::class, "entrevista_id", "id");
    }
}
