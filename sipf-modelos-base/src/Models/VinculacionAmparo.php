<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class VinculacionAmparo extends FFV
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'vinculacion_amparos';

    protected $fillable = [
        'id',
        'vinculacion_id',
        'circuito',
        'juzgado',
        'numero_amaparo',
        'fecha_amparo',
        'observacion_presentacion_amparo',
        'fecha_resolucion_amparo',
        'observacion_resolucion_amparo',
        'sentido_resolucion_amparo',
        'ruta_amparo',
        'ruta_amparo_resolucion',
        'readonly'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function juzgado()
    {
        return $this->flex();
    }

    public function sentido_resolucion_amparo()
    {
        return $this->flex();
    }

    public function vinculacion()
    {
        return $this->belongsTo(Vinculacion::class);
    }
}
