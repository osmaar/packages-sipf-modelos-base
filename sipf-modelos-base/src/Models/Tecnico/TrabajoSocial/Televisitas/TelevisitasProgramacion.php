<?php

namespace Sipf\ModelosBase\Models\Tecnico\TrabajoSocial\Televisitas;

use Sipf\ModelosBase\Models\FFV;
use Sipf\ModelosBase\Models\Centro;
use Sipf\ModelosBase\Models\Persona;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TelevisitasProgramacion extends FFV
{
    use HasFactory;

    protected $table = "televisitas";
    protected $primaryKey = "id";

    protected $guarded = [];

    public function estatus()
    {
        return $this->flex();
    }

    public function tipo()
    {
        return $this->flex();
    }

    public function centro()
    {
        return $this->hasOne(Centro::class, "id", "centro");
    }

    public function centro_destino()
    {
        return $this->hasOne(Centro::class, "id", "centro_destino");
    }

    public function ppl_id()
    {
        return $this->hasOne(Persona::class, "id", "ppl_id");
    }

    public function ppl_destino()
    {
        return $this->hasOne(Persona::class, "id", "ppl_destino");
    }

    public function familiares()
    {
        return $this->hasMany(TelevisitasPropuestasVisitantes::class, "televisita_id", "id");
    }

    public function televisitas_reprogramadas()
    {
        return $this->hasMany(TelevisitasReprogramadas::class, "televisita_id", "id");
    }
}
