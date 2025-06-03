<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotografiaSubclasificacion extends Model
{
    use HasFactory;

    protected $fillable = ['fotografia_clasificacion_id', 'nombre'];
    protected $table = 'fotografia_subclasificaciones';

    public function clasificacion()
    {
        return $this->belongsTo(FotografiaClasificacion::class, 'fotografia_clasificacion_id');
    }
}
