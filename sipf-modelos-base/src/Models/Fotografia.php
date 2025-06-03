<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fotografia extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'persona_id',
        'descripcion_larga',
        'descripcion_corta',
        'status',
        'ruta_fisica',
        'fotografia_clasificacion_id',
        'fotografia_subclasificacion_id',
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }

    public function clasificacion()
    {
        return $this->belongsTo(FotografiaClasificacion::class, 'fotografia_clasificacion_id');
    }

    public function subclasificacion()
    {
        return $this->belongsTo(FotografiaSubclasificacion::class, 'fotografia_subclasificacion_id');
    }
}
