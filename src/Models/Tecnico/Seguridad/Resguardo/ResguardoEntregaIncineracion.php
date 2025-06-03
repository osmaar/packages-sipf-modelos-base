<?php

namespace Sipf\ModelosBase\Models\Tecnico\Seguridad\Resguardo;

use Sipf\ModelosBase\Models\Flexfield;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ResguardoEntregaIncineracion extends Flexfield
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "resguardo_pertenencias_e_i";
    protected $fillable = [
        "folio_resguardo_id",
        "group_id",
        "pathFileEI",
        "nameEntregaFile",
        "nameIncineracionFile",
        "fecha_entrega",
        "hora_entrega",
        "tipo_entrega",
        "parentesco",
        "nombre_familiar_entrega",
        "descripcion_entrega",
        "entrega_a",
        "observaciones_entrega",
        "fecha_incineracion",
        "hora_incineracion",
        "realiza_incineracion",
        "autoriza_incineracion",
        "observaciones_incineracion"
    ];
    public function pertenenciasObjetos()
    {
        return $this->belongsTo(ResguardoPertenenciaObjeto::class, 'folio_resguardo_id', 'idGroup')
            ->whereColumn('resguardo_pertenencias_objetos.folio_resguardo_id', '=', 'resguardo_pertenencias_e_i.folio_resguardo_id');
    }

    public function pertenencias()
    {
        return $this->hasMany(ResguardoPertenenciaObjeto::class, 'ei_id', 'id');
    }

    public function entregaIncineracion()
    {
        return $this->hasMany(ResguardoPertenenciaObjeto::class, 'id', 'ei_id');
    }

    public function idGroup()
    {
        return $this->hasMany(ResguardoPertenenciaObjeto::class, 'idGroup', 'group_id');
    }

    public function pertenencias02()
    {
        return $this->hasMany(ResguardoPertenenciaObjeto::class, 'folio_resguardo_id', 'folio_resguardo_id')
            ->whereColumn('resguardo_pertenencias_e_i.group_id', '=', 'resguardo_pertenencias_objetos.idGroup');
    }

    public function resguardo()
    {
        return $this->belongsTo(ResguardoFolio::class, 'folio_resguardo_id', 'id');
    }
}
