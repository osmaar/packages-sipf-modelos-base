<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EntregaPertenencia extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        "resguardo_id",
        "fecha_entrega",
        "entregado_a",
        "tipo_entrega",
        "otro",
        "observaciones",
        "archivo_entregadas"
    ];

    public function resguardo()
    {
        return $this->belongsTo(Resguardo::class, "reguardo_id", "id");
    }
}
