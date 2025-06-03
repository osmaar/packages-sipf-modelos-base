<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sentencia extends FFV
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'sentencias';

    protected $fillable = [
        'proceso_id',
        'autoridad_resuelve',
        'procedimiento_abreviado',
        'primera_anios',
        'primera_meses',
        'primera_dias',
        'fecha_resolucion_primera',
        'reparacion_danio',
        'multa',
        'fecha_a_partir_de',
        'abono_anios',
        'abono_meses',
        'abono_dias',
        'causal_ejecutoria',
        'fecha_ejecutoria',
        'dinamica_delito',
        'ruta_oficio',
        'readonly',
        'sentencia_absolutoria',
        'observacion_sentencia'
    ];

    public $rules = [
        'proceso_id' => 'required|integer',
        'fecha_resolucion_primera'  => 'required|date',
    ];

    public function getDiasTranscurridosAttribute()
    {
        $fecha_a_partir_de = date_create($this->fecha_a_partir_de);
        $fecha_actual = date_create();
        $intervalo = date_diff($fecha_actual, $fecha_a_partir_de);
        $dias = $intervalo->format("%a");
        return (int) $dias;
    }

    public function autoridad_resuelve()
    {
        return $this->flex();
    }

    public function procedimiento_abreviado()
    {
        return $this->flex();
    }

    public function primera_anios()
    {
        return $this->flex();
    }

    public function primera_meses()
    {
        return $this->flex();
    }

    public function primera_dias()
    {
        return $this->flex();
    }

    public function reparacion_danio()
    {
        return $this->flex();
    }

    public function multa()
    {
        return $this->flex();
    }

    public function abono_anios()
    {
        return $this->flex();
    }

    public function abono_meses()
    {
        return $this->flex();
    }

    public function abono_dias()
    {
        return $this->flex();
    }

    public function causal_ejecutoria()
    {
        return $this->flex();
    }

    public function dinamica_delito()
    {
        return $this->flex();
    }

    public function created_at()
    {
        return $this->flex();
    }

    public function updated_at()
    {
        return $this->flex();
    }
}
