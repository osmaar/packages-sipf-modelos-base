<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Resguardo extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "resguardo_pertenencias";
    protected $fillable = [
        "expediente_id",
        "folio",
        "fecha",
        "responsable",
        "tipo_objeto",
        "descripcion_objeto",
        "estado",
        "valor_objeto",
        "observaciones",
        "status",
        "centro_id",
        "archivo_resguardo",
        "tipo_resguardo",
        "folio_correspondencia"
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }

    public function entregados()
    {
        return $this->hasMany(EntregaPertenencia::class, "resguardo_id", "id");
    }

    public function incinerados()
    {
        return $this->hasMany(IncineracionPertenencia::class, "resguardo_id", "id");
    }

    public function dinero()
    {
        return $this->hasMany(ResguardoDinero::class, "resguardo_id", "id");
    }
}
