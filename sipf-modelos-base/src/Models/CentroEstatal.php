<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CentroEstatal extends Model
{
    use HasFactory;

    protected $table = 'centros_estatales';

    public function getEstado()
    {
        return $this->belongsTo(SepomexEstado::class);
    }
}
