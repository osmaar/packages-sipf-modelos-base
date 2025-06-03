<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Incidente extends FFV
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'incidentes';
    protected $fillable = [
        'centro_id',
        'expediente_id',
        'folio',
        'participacion_incidente',
        "fecha_incidente",
        "hora_incidente",
        "personal_de_custodia",
        "tipo_incidente",
        "tipo_incidente_descripcion",
        "lugar_incidente",
        "revisa_ct",
        "ruta_registro_incidente",
        "descripcion"

    ];

    public function involucrados()
    {
        return $this->hasMany(IncidenteInvolucrados::class);
    }


    public function tipo_incidente()
    {
        return $this->flex();
    }

    public function ppls()
    {
        return $this->hasMany(IncidentePpls::class);
    }

    public function expediente()
    {
        return $this->belongsTo(Expediente::class);
    }
}
