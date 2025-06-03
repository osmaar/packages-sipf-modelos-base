<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class CentroUbicaciones extends FFV
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'centro_ubicaciones';


    public function ubicacion_id()
    {
        return $this->flex();
    }

    public function centro_id()
    {
        return $this->belongsTo(Centro::class);
    }
}
