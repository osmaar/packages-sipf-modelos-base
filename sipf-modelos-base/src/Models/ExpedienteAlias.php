<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExpedienteAlias extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'expediente_alias';

    public function expediente()
    {
        return $this->belongsTo(Expediente::class);
    }
}
