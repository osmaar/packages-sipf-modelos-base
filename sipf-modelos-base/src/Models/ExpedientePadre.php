<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpedientePadre extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function expediente()
    {
        return $this->belongsTo(Expediente::class);
    }
}
