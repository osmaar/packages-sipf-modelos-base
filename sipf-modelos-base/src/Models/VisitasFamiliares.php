<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class VisitasFamiliares extends FFV
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'visita_familiares';

    protected $fillable = [
        "persona_id",
        "expediente_id",
        "user_id",
        "modulo",
        "tipo_programacion",
        "tipo_visita",
        "dia_visita",
        "turno",
        "lugar",
        "estatus_visita",
        "estatus_autorizacion",
        "hora_inicio",
        "hora_fin",
        "fecha_registro_estatus",
        "fecha_actualiza_estatus",
        "observaciones",
    ];

    public function tipo_programacion()
    {
        return $this->flex();
    }

    public function tipo_visita()
    {
        return $this->flex();
    }

    public function modulo()
    {
        return $this->flex();
    }

    public function dia_visita()
    {
        return $this->flex();
    }

    public function turno()
    {
        return $this->flex();
    }

    public function lugar()
    {
        return $this->flex();
    }

    public function estatus_visita()
    {
        return $this->flex();
    }
    public function estatus_autorizacion()
    {
        return $this->flex();
    }

    public function expediente()
    {
        return $this->belongsTo(Expediente::class);
    }

    public function personas()
    {
        return $this->belongsTo(Persona::class);
    }
}
