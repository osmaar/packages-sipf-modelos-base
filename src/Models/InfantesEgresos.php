<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class InfantesEgresos extends FFV
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'infantes_egresos';
    protected $guarded = [];



    public function estatus()
    {
        return $this->flex();
    }
}
