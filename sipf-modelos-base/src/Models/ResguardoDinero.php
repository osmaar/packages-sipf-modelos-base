<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class ResguardoDinero extends FFV
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "resguardo_dinero";
    protected $fillable = [
        "id",
        "resguardo_id",
        "pais_id",
        "tipo_dinero",
        "valor_dinero",
        "otro_valor",
        "cantidad",
        "autoriza",
    ];

    public function resguardo_id()
    {
        return $this->belongsTo(Resguardo::class, "reguardo_id", "id");
    }

    public function pais_id()
    {
        return $this->flex();
    }
}
