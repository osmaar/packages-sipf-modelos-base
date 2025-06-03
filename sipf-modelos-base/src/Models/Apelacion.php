<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Apelacion extends FFV
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'apelaciones';

    protected $fillable = [
        'toca',
        'fuero',
        'proceso_id',
        'estado_id',
        'circuito',
        'autoridad_resuelve',
        'autoridad_resuelve_otro',
        'sentido_resolucion_apelacion',
        'apelacion_anios',
        'apelacion_meses',
        'apelacion_dias',
        'fecha_apelacion',
        'observacion_presenta_apelacion_sentencia',
        'fecha_resolucion',
        'reparacion_danio',
        'multa',
        'ruta_apelacion',
        'ruta_apelacion_resolucion',
        'readonly',
        'observacion_resolucion_apelacion_sentencia',
        'sentencia_primera_anios_original',
        'sentencia_primera_meses_original',
        'sentencia_primera_dias_original',
        'sentencia_reparacion_danio_original',
        'sentencia_multa_original'
    ];

    public $rules = [
        'toca' => 'required|string',
        'autoridad_resuelve' => 'required|string',
        'sentido_resolucion_apelacion' => 'required|string',
        'apelacion_anios' => 'required|string',
        'apelacion_meses' => 'required|string',
        'apelacion_dias' => 'required|string',
        'fecha_resolucion' => 'required|string',
        'reparacion_danio' => 'required|string',
        'multa' => 'required|string',
    ];

    public function autoridad_resuelve()
    {
        return $this->flex();
    }

    public function sentido_resolucion_apelacion()
    {
        return $this->flex();
    }

    public function proceso()
    {
        return $this->belongsTo(Proceso::class);
    }
}
