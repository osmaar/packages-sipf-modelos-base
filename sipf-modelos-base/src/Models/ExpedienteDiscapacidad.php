<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpedienteDiscapacidad extends FFV
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'expediente_discapacidades';

    public function discapacidad()
    {
        return $this->flex();
    }

    public function expediente()
    {
        return $this->belongsTo(Expediente::class);
    }
}
