<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Sipf\ModelosBase\Models\Tecnico\Criminologia\UbicacionReubicacion;

class PaseListaDetalle extends Model
{
    use HasFactory;

    protected $fillable = [
        'pase_lista_id',
        'ubicacion_reubicacion_id',
        'persona_id',
        'estatus',
        'observacion',
        'motivo'
    ];

    public static $estatusOptions = ['ausente' => 'ausente', 'presente' => 'presente', 'traslado_temporal' => 'traslado_temporal', 'pendiente' => 'pendiente'];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if (!in_array($model->estatus, self::$estatusOptions)) {
                throw new \InvalidArgumentException("Estatus inválido: {$model->estatus}");
            }
        });
    }

    // Relación con PaseLista
    public function paseLista()
    {
        return $this->belongsTo(PaseLista::class);
    }

    // Relación con UbicacionReubicacion (asumiendo que tienes un modelo para esta tabla)
    public function ubicacionReubicacion()
    {
        return $this->belongsTo(UbicacionReubicacion::class);
    }
}
