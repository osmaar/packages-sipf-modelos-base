<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Infantes extends FFV
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'infantes';
    protected $guarded = [];

    protected $appends = [
        'nombre_completo'
    ];


    public function estatus()
    {
        return $this->flex();
    }
    public function getNombreCompletoAttribute()
    {
        return $this->nombre . ' ' . $this->primer_apellido . ' ' . $this->segundo_apellido;
    }


    public static function calcularConsecutivo($centro_id, $anio)
    {
        $consecutivo = 1;
        $infante = Infantes::where("centro_id", "=", $centro_id)
            ->whereYear("created_at", $anio)
            ->select("consecutivo")
            ->orderBy('consecutivo', 'DESC')->first();
        if ($infante) {
            $ultimo_consecutivo = $infante->consecutivo;
            $consecutivo = intval($ultimo_consecutivo) + 1;
        }
        return $consecutivo;
    }
}
