<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class InfantesReingresos extends FFV
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'infantes_reingresos';
    protected $guarded = [];

    public function estatus()
    {
        return $this->flex();
    }
}
