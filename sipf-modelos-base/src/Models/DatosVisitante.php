<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class DatosVisitante extends FFV
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'visitas_datos_visitante';

    protected $fillable = [
        "autoridad_resuelve",
        "fecha_resolucion_primera",
    ];

    public $rules = [
        'proceso_id' => 'required|integer',
        'fecha_resolucion_primera'  => 'required|date',
    ];

    public function updated_at()
    {
        return $this->flex();
    }
}
