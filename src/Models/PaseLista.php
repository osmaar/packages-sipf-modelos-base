<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Sipf\ModelosBase\Models\Tecnico\Seguridad\PaseDeLista\ReglaDeAsignacion;
use Sipf\ModelosBase\Models\Tecnico\Seguridad\PaseDeLista\Turno;

class PaseLista extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'centro_id',
        'user_id',
        'turno_id',
        'regla_asignacion_id',
        'resultados',
        'estatus',
    ];

    public static $estatusOptions = ['pendiente' => 'pendiente', 'en_proceso' => 'en_proceso', 'finalizado' => 'finalizado'];

    public static $estatusDescriptions = [
        'pendiente' => 'Pendiente de inicio',
        'en_proceso' => 'En proceso',
        'finalizado' => 'Finalizado correctamente'
    ];

    // Obtener una descripción legible del estatus
    public function getEstatusTextoAttribute()
    {
        return self::$estatusDescriptions[$this->estatus] ?? 'Estatus desconocido';
    }

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if (!in_array($model->estatus, self::$estatusOptions)) {
                throw new \InvalidArgumentException("Estatus inválido: {$model->estatus}");
            }
        });
    }

    protected $casts = [
        'resultados' => 'array', // Almacenar resultados como array
    ];

    // Relación con User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con Centro
    public function centro()
    {
        return $this->belongsTo(Centro::class);
    }

    // Relación con Turno
    public function turno()
    {
        return $this->belongsTo(Turno::class);
    }

    // Relación con Regla de Asignación
    public function reglaAsignacion()
    {
        return $this->belongsTo(ReglaDeAsignacion::class);
    }

    public function PaseListaDetalle()
    {
        return $this->hasMany(PaseListaDetalle::class);
    }
}
