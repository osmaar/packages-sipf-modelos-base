<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class InfantesHistoricos extends FFV
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'infantes_historicos';
    protected $guarded = [];

    public function estatus_infante_asignado()
    {
        return $this->flex();
    }

    public static function calcularConsecutivo($infante_id)
    {
        $consecutivo = 1;
        $infanteHistorico = InfantesHistoricos::where("infante_id", "=", $infante_id)
            ->select("numero")
            ->orderBy('numero', 'DESC')->first();
        if ($infanteHistorico) {
            $ultimo_consecutivo = $infanteHistorico->numero;
            $consecutivo = intval($ultimo_consecutivo) + 1;
        }
        return $consecutivo;
    }
}
