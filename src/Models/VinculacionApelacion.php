<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class VinculacionApelacion extends FFV
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'vinculacion_apelaciones';

    protected $fillable = [
        'id',
        'vinculacion_id',
        'fecha_apelacion',
        'fecha_resolucion_apelacion',
        'fuero',
        'circuito',
        'estado_id',
        'autoridad_resuelve',
        'autoridad_resuelve_otro',
        'sentido_resolucion_apelacion',
        'ruta_apelacion',
        'observacion_presenta_apelacion',
        'ruta_apelacion_resolucion',
        'readonly',
        'observacion_resolucion_apelacion'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function autoridad_resuelve()
    {
        return $this->flex();
    }

    public function sentido_resolucion_apelacion()
    {
        return $this->flex();
    }

    public function vinculacion()
    {
        return $this->belongsTo(Vinculacion::class);
    }
}
