<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpedienteOtroNombre extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'expediente_otros_nombres';

    public function expediente()
    {
        return $this->belongsTo(Expediente::class);
    }
}
