<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VisitasCredenciales extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        "visitante_id",
        "fecha_entrega",
        "codigoqr",
        "foto_file",
        "estatus",
        "fecha_emision"
    ];

    public function visitante()
    {
        return $this->belongsTo(DatosVisitante::class, "visita_id", "id");
    }
}
