<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Antecedente extends FFV
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'antecedentes';

    protected $fillable = [
        'expediente_id',
        'causa_penal',
        'sistema_penal',
        'fuero',
        'circuito',
        'autoridad_judicial',
        'circuito_estado_id',
        'autoridad_judicial_otro',
        'expediente_ejecucion',
        'fecha_sentencia',
        'fecha_a_partir_de',
        'fecha_ejecutoria',
        'apelacion',
        'toca_penal_apelacion',
        'fecha_resolucion_apelacion',
        'autoridad_judicial_ape',
        'pena_anios',
        'pena_meses',
        'pena_dias',
        'abono_anios',
        'abono_meses',
        'abono_dias',
        'amparo_directo',
        'fecha_libertad',
        'observaciones',
        'pena_fuero',
        'pena_autoridad_resuelve',
        'pena_circuito',
        'pena_estado_id',
        'pena_autoridad_resuelve_otro'
    ];

    public function sistema_penal()
    {
        return $this->flex();
    }

    public function fuero()
    {
        return $this->flex();
    }

    public function autoridad_judicial()
    {
        return $this->flex();
    }

    public function autoridad_judicial_ape()
    {
        return $this->flex();
    }

    public function delitos()
    {
        return $this->hasMany(AntecedenteDelito::class);
    }

    public function expediente()
    {
        return $this->belongsTo(Expediente::class);
    }
}
