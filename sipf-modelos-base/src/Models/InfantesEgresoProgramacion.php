<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class InfantesEgresoProgramacion extends FFV
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'infantes_egreso_programacion';
    protected $guarded = [];
}
