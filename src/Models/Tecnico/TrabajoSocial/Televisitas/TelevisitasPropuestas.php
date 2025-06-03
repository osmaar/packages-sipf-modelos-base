<?php

namespace Sipf\ModelosBase\Models\Tecnico\TrabajoSocial\Televisitas;

use Sipf\ModelosBase\Models\FFV;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Sipf\ModelosBase\Models\Persona;
use Sipf\ModelosBase\Models\PersonaReferencia;

class TelevisitasPropuestas extends FFV
{
    use HasFactory;

    protected $table = "televisitas_propuestas";
    protected $primaryKey = "id";

    protected $guarded = [];

    public function estatus_autorizacion_propuesta()
    {
        return $this->flex();
    }

    public function estatus_propuesta()
    {
        return $this->flex();
    }

    public function tipo_televisita()
    {
        return $this->flex();
    }

    public function persona_id_familiar()
    {
        return $this->hasOne(PersonaReferencia::class, "referencia_id", "persona_id");
    }

    public function persona_id_ppl()
    {
        return $this->hasOne(Persona::class, "id", "persona_id");
    }

    public function parentesco_id()
    {
        return $this->flex();
    }
}
