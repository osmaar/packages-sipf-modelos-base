<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Juridico\LibertadProcesoRespaldo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Sipf\ModelosBase\Models\CatalogosFlexFields\TipoLibertad;
use Sipf\ModelosBase\Models\CatalogosFlexFields\AutoridadJudicial;

class Libertad extends FFV
{
  use HasFactory;
  use SoftDeletes;

  protected $table = 'libertades';

  protected $fillable = [
    'proceso_id',
    'tipo_libertad_id',
    'fecha_libertad',
    'circuito',
    'autoridad_judicial_id',
    'no_oficio_libertad',
    'oficio_libertad',
    'persona_autoriza',
    'cargo_persona_autoriza',
    'observaciones',
    'revocada'
  ];

  /**
   *Relaciones Eloquent
   */

  public function tipoLibertad()
  {
    return $this->belongsTo(TipoLibertad::class, "tipo_libertad_id", "id");
  }
  public function autoridadJudicial()
  {
    return $this->belongsTo(AutoridadJudicial::class, "autoridad_judicial_id", "id");
  }
  public function tipo_libertad()
  {
    return $this->flex();
  }

  public function autoridad_judicial()
  {
    return $this->flex();
  }

  public function proceso()
  {
    return $this->belongsTo(Proceso::class);
  }

  public function sentencia()
  {
    return $this->belongsTo(Sentencia::class, "proceso_id", "proceso_id");
  }

  public function libertadProcesoRespaldo()
  {
    return $this->hasOne(LibertadProcesoRespaldo::class, "libertad_id", "id");
  }

  public function apelacion()
  {
    return $this->hasOne(LibertadApelacion::class, "libertad_id", "id");
  }

  public function amparo()
  {
    return $this->hasOne(LibertadAmparo::class, "libertad_id", "id");
  }

  public function recursoRevision()
  {
    return $this->hasOne(LibertadRecursoRevision::class, "libertad_id", "id");
  }

  /**
   *Scopes
   */
  public function scopePorExpediente($query, $id_expediente)
  {
    return $query->join('procesos', 'procesos.id', "libertades.proceso_id")
      ->where("procesos.expediente_id", "=", $id_expediente)
      ->select("libertades.*");
  }

  public function scopeActiva($query)
  {
    return $query->where("revocada", "=", 0);
  }

  public function getHoraAttribute()
  {

    $date = date_create($this->fecha_libertad);
    return date_format($date, "H:i");
  }
}
