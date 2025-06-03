<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class IncidentePpls extends FFV
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'incidente_ppls';

    public function incidente()
    {
        return $this->belongsTo(Incidente::class);
    }

    public function expediente()
    {
        return $this->belongsTo(Expediente::class);
    }
}
