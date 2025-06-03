<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vinculacion extends Model
{
    use HasFactory;
    //se SoftDeletes;

    protected $table = 'vinculaciones';

    protected $fillable = [
        'id',
        'fecha_consignacion',
        'carpeta_investigacion',
        'fecha_inicio_investigacion',
        'fecha_vinculacion',
        'fecha_detencion',
        'calidad_delincuencial',
        'amparo_indirecto',
        'apelacion',
        'coacusados',
        'ruta_oficio',
        'readonly',
        'observacion_vinculacion',
        'isCd',
    ];

    protected $rules = [
        'id' => 'integer|required',
        'fecha_consignacion' => 'date',
        'carpeta_investigacion' => 'string|max:50',
        'fecha_inicio_investigacion' => 'date',
        'fecha_vinculacion' => 'date|required',
        'fecha_detencion' => 'date|required',
        'calidad_delincuencial' => 'integer|required',
        'amparo_indirecto' => 'in:Si,No',
        'apelacion' => 'in:Si,No',
        'coacusados' => 'in:Si,No',

    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];



    public function proceso()
    {
        return $this->belongsTo(Proceso::class);
    }

    public function amparos()
    {
        return $this->hasMany(VinculacionAmparo::class);
    }

    public function apelaciones()
    {
        return $this->hasMany(VinculacionApelacion::class);
    }

    public function coacusados()
    {
        return $this->hasMany(VinculacionCoacusado::class);
    }
}
