<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Representantes extends FFV
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'representantes_procuraduria';
    protected $guarded = [];
    protected     $dates          = ['deleted_at'];

    public function tipo_identificacion()
    {
        return $this->flex();
    }
}
