<?php

namespace Sipf\ModelosBase\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;

class Expediente extends FFV
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'expedientes';

    public $camposBusqueda = ['num_expediente', 'cib'];

    protected $fillable = [
        'persona_id',
        'centro_id',
        'num_expediente',
        'cib',
        'estatus',
        'estatus_antecendetes',
        'estatus_seccion_proceso',
        'estatus_beneficios',
        'ppl_existente',
        'institucion_internacional',
        'folio_resguardo',
        'abrir_procesos',
        'readonly',
        'readonly_info',
        'readonly_senia',
        'readonly_biometrico',
        'consecutivo',
        'procedencia_centro',
        'procedencia_estado',
    ];

    protected $hidden = [
        "tipo_ingreso",
        "tipo_ingreso_desc",
        "procedencia_pais",
        "procedencia_centro",
        "procedencia_estado",
        "fiscalia",
        "fecha_ingreso"
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

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }

    public function centro()
    {
        return $this->belongsTo(Centro::class, 'centro_id', 'id');
    }

    public function movimientos()
    {
        return $this->hasMany(ExpedienteMovimiento::class, 'expediente_id', 'id');
    }

    public function antecedentes()
    {
        return $this->hasMany(Antecedente::class);
    }

    public function procedenciaPais()
    {
        return $this->hasOne(CatPais::class, 'id', 'procedencia_pais')
            ->select(['id', 'clave', 'desc']);
    }

    public function procedenciaEstado()
    {
        return $this->hasOne(SepomexEstado::class, 'c_estado', 'procedencia_estado')
            ->select(['c_estado', 'd_estado']);
    }

    public function procesos()
    {
        return $this->hasMany(Proceso::class);
    }

    public function procesoActual()
    {
        return $this->hasOne(Proceso::class)->actual();
    }

    public function egresosTemporales()
    {
        return $this->hasMany(EgresoTemporal::class);
    }

    public function egresoTemporalActivo()
    {
        return $this->hasOne(EgresoTemporal::class)->activo();
    }

    public function ultimoEgresoTemporal()
    {
        return $this->hasOne(EgresoTemporal::class)->ultimo();
    }

    public function traslados()
    {
        return $this->hasMany(Traslado::class);
    }

    public function trasladoActivo()
    {
        return $this->hasOne(Traslado::class)->activo();
    }

    public function ultimoTraslado()
    {
        return $this->hasOne(Traslado::class, "expediente_id", "id")
            ->ultimo();
    }

    public function evasiones()
    {
        return $this->hasMany(Evasion::class);
    }

    public function evasionActiva()
    {
        return $this->hasOne(Evasion::class)->activa();
    }

    public function ultimaEvasion()
    {
        return $this->hasOne(Evasion::class, "expediente_id", "id")
            ->ultima();
    }

    public function egresoLibertad()
    {
        return $this->hasOne(EgresoLibertad::class);
    }


    public function defuncionActiva()
    {
        return $this->hasOne(Defuncion::class);
    }

    public function egreso_temporal()
    {
        return $this->hasMany(EgresoTemporal::class);
    }

    public function traslado()
    {
        return $this->hasMany(Traslado::class);
    }

    public function evasion()
    {
        return $this->hasMany(Evasion::class);
    }

    public function defuncion()
    {
        return $this->hasOne(Defuncion::class);
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

    public function scopeAbierto($query)
    {
        return $query->where("estatus", "=", "Abierto");
    }

    public function getEstaAbiertoAttribute()
    {
        if (in_array($this->estatus, ['Abierto'])) {
            return true;
        }
        return false;
    }

    public function getEsCerradoPorDefuncionAttribute()
    {
        if ($this->estatus == "Cerrado" && $this->estatus_centro == "defuncion") {
            return true;
        }
        return false;
    }
    public function getEsCerradoPorTrasladoAttribute()
    {
        if ($this->estatus == "Cerrado" && $this->estatus_centro == "traslado") {
            return true;
        }
        return false;
    }

    public function getEsTemporalAttribute()
    {
        if ($this->estatus_centro == "temporal") {
            return true;
        }
        return false;
    }

    public function getUltimaFechaIngresoAttribute()
    {
        $ultimo_movimiento = $this->movimientos()->orderBy("id", "desc")->first();
        if ($ultimo_movimiento) {
            $dateFull = new DateTime($ultimo_movimiento->fecha_ingreso);
            $date = $dateFull->format('d/m/Y');
            return $date;
        }
        return "---";
    }

    public function getUltimaHoraIngresoAttribute()
    {
        $ultimo_movimiento = $this->movimientos()->orderBy("id", "desc")->first();
        if ($ultimo_movimiento) {
            $dateFull = new DateTime($ultimo_movimiento->fecha_ingreso);
            $date = $dateFull->format('h:i');
            return $date;
        }
        return "---";
    }

    public function getUltimaFechaIngresoSFAttribute()
    {
        $ultimo_movimiento = $this->movimientos()->orderBy("id", "desc")->first();
        if ($ultimo_movimiento) {
            $dateFull = new DateTime($ultimo_movimiento->fecha_ingreso);
            $date = $dateFull->format('Y/m/d');
            return $date;
        }
        return "---";
    }

    public function getUltimaFechaHoraIngresoSFAttribute()
    {
        $ultimo_movimiento = $this->movimientos()->orderBy("id", "desc")->first();
        if ($ultimo_movimiento) {
            $dateFull = new DateTime($ultimo_movimiento->fecha_ingreso);
            $date = $dateFull->format('Y/m/d H:i');
            return $date;
        }
        return "---";
    }

    public static function calcularNumeroExpediente($centro_id, $consecutivo)
    {
        $centro = Centro::find($centro_id);
        $nomenclatura_centro = $centro->nomenclatura_centro;
        $anio = date("Y");
        return rtrim($nomenclatura_centro, "/") . "/" . sprintf("%06d", $consecutivo) . "/" . $anio;
    }

    public static function calcularConsecutivo($centro_id)
    {
        $consecutivo = 1;
        $centro = Centro::find($centro_id);
        Log::info($centro_id);
        Log::info($centro->consecutivo_inicio);
        $expediente = Expediente::where("centro_id", "=", $centro_id)
            ->select("consecutivo")
            ->orderBy('consecutivo', 'DESC')->first();
        if ($expediente && $expediente->consecutivo >= 1) {
            $ultimo_consecutivo = $expediente->consecutivo;
            $consecutivo = intval($ultimo_consecutivo) + 1;
        } elseif ($centro && $centro->consecutivo_inicio > 1) {
            $consecutivo = $centro->consecutivo_inicio;
        }
        return $consecutivo;
    }
}
