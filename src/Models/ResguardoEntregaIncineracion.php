<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        return $this->belongsTo(ResguardoPertenencia::class, 'folio_resguardo_id', 'idGroup')
            ->whereColumn('resguardo_pertenencias_objetos.folio_resguardo_id', '=', 'resguardo_pertenencias_e_i.folio_resguardo_id');
    }

    public function pertenencias()
    {
        return $this->hasMany(ResguardoPertenencia::class, 'ei_id', 'id');
    }

    public function entregaIncineracion()
    {
        return $this->hasMany(ResguardoPertenencia::class, 'id', 'ei_id');
    }

    public function idGroup()
    {
        return $this->hasMany(ResguardoPertenencia::class, 'idGroup', 'group_id');
    }

    public function pertenencias02()
    {
        return $this->hasMany(ResguardoPertenencia::class, 'folio_resguardo_id', 'folio_resguardo_id')
            ->whereColumn('resguardo_pertenencias_e_i.group_id', '=', 'resguardo_pertenencias_objetos.idGroup');
    }
}
