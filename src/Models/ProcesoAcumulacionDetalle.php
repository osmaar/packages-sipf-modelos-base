<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcesoAcumulacionDetalle extends Model
{
    use HasFactory;

    protected $table = 'proceso_acumulacion_detalle';

    public function proceso_acumulacion()
    {
        return $this->belongsTo(ProcesoAcumulacion::class, 'proceso_acumulacion_id', 'id');
    }

    public function procesos()
    {
        return $this->belongsTo(Proceso::class, 'proceso_id', 'id');
    }

    protected $fillable = [
        'proceso_acumulacion_id',
        'proceso_id'
    ];
    public static $rules = [
        'proceso_acumulacion_id' => 'required|integer',
        'proceso_id' => 'required|integer',
    ];
}
