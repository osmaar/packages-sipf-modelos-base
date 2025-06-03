<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpedienteMovimiento extends FFV
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'expediente_movimientos';

    protected $fillable = [
        'centro_destino',
        'circuito',
        'autoridad_judicial',
        'fuero',
        'circuito_estado_id',
        'autoridad_judicial_otro',
        'expediente_id',
        'tipo_ingreso',
        'es_nuevo_ingreso',
        'tipo_ingreso_desc',
        'procedencia_pais',
        'procedencia_centro',
        'procedencia_estado',
        'fiscalia',
        'fecha_ingreso',
        'institucion_internacional',
        'folio_resguardo'
    ];

    public $rules = [
        'expediente_id' => 'integer|required',
        'tipo_ingreso' => 'integer|required',
        'tipo_ingreso_desc' => 'integer|required',
        'procedencia_pais' => 'integer',
        'procedencia_centro' => 'integer',
        'procedencia_estado' => 'integer',
        'fiscalia' => 'string|max:100',
        'fecha_ingreso' => 'date_format:Y-m-d H:i:s|required'
    ];

    public function tipo_ingreso()
    {
        return $this->flex();
    }

    public function tipo_ingreso_desc()
    {
        return $this->flex();
    }

    public function procedencia_centro()
    {
        return $this->flex();
    }

    public function procedencia_pais()
    {
        return $this->hasOne(CatPais::class, 'id', 'procedencia_pais')
            ->select(['id', 'clave', 'desc']);
    }

    public function procedencia_estado()
    {
        return $this->hasOne(SepomexEstado::class, 'c_estado', 'procedencia_estado')
            ->select(['c_estado', 'd_estado']);
    }

    public function expediente()
    {
        return $this->belongsTo(Expediente::class);
    }

    public function scopeUltimo($query)
    {
        return $query->latest('updated_at')->take(1);
    }

    public function getFechaIngresoFormatAttribute()
    {
        $date = date_create($this->fecha_ingreso);
        return date_format($date, "d/m/Y");
    }

    public function tipoIngreso()
    {
        return $this->belongsTo(FlexfieldValue::class, 'tipo_ingreso_desc', 'id');
    }
}
