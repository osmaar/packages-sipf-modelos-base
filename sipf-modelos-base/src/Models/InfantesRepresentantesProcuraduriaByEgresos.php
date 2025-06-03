<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class InfantesRepresentantesProcuraduriaByEgresos extends FFV
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'infantes_representantes_procuraduria_by_egresos';
    protected $guarded = [];



    public function estatus()
    {
        return $this->flex();
    }
}
