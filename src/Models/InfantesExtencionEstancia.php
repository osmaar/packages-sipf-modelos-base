<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class InfantesExtencionEstancia extends FFV
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'infantes_extencion_estancia';
    protected $guarded = [];
}
