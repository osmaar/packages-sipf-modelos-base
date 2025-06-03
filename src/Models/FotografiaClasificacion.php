<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotografiaClasificacion extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'codigo'];
    protected $table = 'fotografia_clasificaciones';

    public function subclasificaciones()
    {
        return $this->hasMany(FotografiaSubclasificacion::class);
    }
}
