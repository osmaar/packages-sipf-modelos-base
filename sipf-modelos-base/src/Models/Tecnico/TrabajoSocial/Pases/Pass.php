<?php

namespace Sipf\ModelosBase\Models\Tecnico\TrabajoSocial\Pases;

use Sipf\ModelosBase\Models\FFV;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pass extends FFV
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'persona_id',
        'parentesco_id',
        'pass',
        'start',
        'end',
        'print',
        'status',
        'active',
        'nombre',
    ];

    public function parentesco()
    {
        return $this->flex();
    }
}
