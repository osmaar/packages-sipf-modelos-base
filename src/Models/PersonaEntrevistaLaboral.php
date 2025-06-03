<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonaEntrevistaLaboral extends FFV
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'persona_entrevista_laboral';


    public function proceso()
    {
        return $this->belongsTo(Proceso::class);
    }

    public function licitos()
    {
        return $this->hasMany(EntrevistaLaboralLicitos::class, "entrevista_id", "id");
    }

    public function ilicitos()
    {
        return $this->hasMany(EntrevistaLaboralIlicitos::class, "entrevista_id", "id");
    }

    public function aptitudes()
    {
        return $this->hasMany(EntrevistaLaboralAptitudes::class, "entrevista_id", "id");
    }

    public function herramientas()
    {
        return $this->hasMany(EntrevistaLaboralHerramientas::class, "entrevista_id", "id");
    }

    public function maquinarias()
    {
        return $this->hasMany(EntrevistaLaboralMaquinarias::class, "entrevista_id", "id");
    }

    public function cursosExternos()
    {
        return $this->hasMany(EntrevistaLaboralCursosExternos::class, "entrevista_id", "id");
    }

    public function impedimentos()
    {
        return $this->hasMany(EntrevistaLaboralImpedimentos::class, "entrevista_id", "id");
    }

    public function incapacidades()
    {
        return $this->hasMany(EntrevistaLaboralIncapacidades::class, "entrevista_id", "id");
    }

    public function actividades()
    {
        return $this->hasMany(EntrevistaLaboralActividadesAnteriores::class, "entrevista_id", "id");
    }

    public function cursos()
    {
        return $this->hasMany(EntrevistaLaboralCursosAnteriores::class, "entrevista_id", "id");
    }

    public function artisticas()
    {
        return $this->hasMany(EntrevistaLaboralHabilidadesArtisticas::class, "entrevista_id", "id");
    }

    public function artesanales()
    {
        return $this->hasMany(EntrevistaLaboralHabilidadesArtesanales::class, "entrevista_id", "id");
    }

    public function base()
    {
        return $this->flex();
    }

    public function servicio()
    {
        return $this->flex();
    }

    public function estatus_actividad()
    {
        return $this->flex();
    }

    public function estatus_autorizacion()
    {
        return $this->flex();
    }

    public function institucion()
    {
        return $this->flex();
    }
}
