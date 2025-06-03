<?php

namespace Sipf\ModelosBase\Models\Tecnico\PlanActividadesPPL;

use Sipf\ModelosBase\Models\Persona;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EntrevistaLaboral extends Model
{
  use HasFactory;
  use SoftDeletes;

  protected $table = "entrevista_laboral";
  protected $fillable = [
    "id",
    "persona_id",
    "estatus_aceptacion",
    "evidencia_rechazo",
    "evidencia",
  ];

  public function persona()
  {
    return $this->belongsTo(Persona::class, "persona_id", "id");
  }
}
