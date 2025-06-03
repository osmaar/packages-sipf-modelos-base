<?php

namespace Sipf\ModelosBase\Models\Tecnico\TrabajoSocial\Televisitas;

use Sipf\ModelosBase\Models\FFV;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TelevisitasPropuestasVisitantes extends FFV
{
    use HasFactory;

    protected $table = "televisitas_propuestas_visitantes";
    protected $primaryKey = "id";

    protected $guarded = [];


    public function propuesta()
    {
        return $this->hasOne(TelevisitasPropuestas::class, "id", "propuesta_id");
    }
}
