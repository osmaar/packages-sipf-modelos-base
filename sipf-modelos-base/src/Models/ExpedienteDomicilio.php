<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpedienteDomicilio extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'expediente_domicilio';

    public function procedencia_estado()
    {
        return $this->hasOne(SepomexEstado::class, 'c_estado', 'c_estado')
            ->select(['c_estado', 'd_estado']);
    }

    public function expediente()
    {
        return $this->belongsTo(Expediente::class);
    }
}
