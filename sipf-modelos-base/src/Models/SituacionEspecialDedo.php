<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class SituacionEspecialDedo extends FFV
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'situacion_especial_dedo';

    public function extremidad_situacion_especial()
    {
        return $this->flex();
    }

    // Elemento padre
    public function expediente()
    {
        return $this->belongsTo(Expediente::class);
    }
}
