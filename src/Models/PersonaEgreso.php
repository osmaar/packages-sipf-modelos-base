<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonaEgreso extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'persona_egresos';

    protected $fillable = [
        'persona_id',
        'expediente_id',
        'centro_id',
        'egreso_id',
        'tipo_egreso',
        'tipo_egreso_desc',
        'centro_destino',
        'centro_transito',
        'estatus',
        'fecha_egreso',
        'datos'
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'persona_id');
    }

    public function expediente()
    {
        return $this->belongsTo(Expediente::class, 'expediente_id');
    }

    public function centro()
    {
        return $this->belongsTo(Centro::class, 'centro_id');
    }

    public function destino()
    {
        return $this->belongsTo(Centro::class, 'centro_destino');
    }
    public function transito()
    {
        return $this->belongsTo(Centro::class, 'centro_transito');
    }
    public function traslado()
    {
        return $this->hasMany(Traslado::class, 'expediente_id', 'expediente_id');
    }
    public function ultimoExpedienteMovimiento()
    {
        return $this->hasOne(ExpedienteMovimiento::class, 'expediente_id', 'expediente_id')->latestOfMany();
    }
}
