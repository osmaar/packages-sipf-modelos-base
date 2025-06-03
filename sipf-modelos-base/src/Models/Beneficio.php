<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Sipf\ModelosBase\Models\CatalogosFlexFields\BeneficioSolicitado;
use Sipf\ModelosBase\Models\CatalogosFlexFields\ReparacionDanioMulta;
use Sipf\ModelosBase\Models\CatalogosFlexFields\ResolucionBeneficio;

class Beneficio extends Model
{
  use HasFactory;
  use SoftDeletes;

  protected $table = 'beneficios';

  protected $fillable = [
    'proceso_id',
    'expediente_beneficio',
    'beneficio_solicitado_id',
    'fecha_solicitud',
    'reparacion_danio_multa_id',
    'resolucion_beneficio_id',
    'no_oficio_beneficio',
    'oficio_beneficio',
    'fecha_resolucion',
    'ruta_resolucion',
    'readonly',
    'ejecucion_id'

  ];

  public $rules = [
    'proceso_id' => 'required|integer',
    'beneficio_solicitado' => 'required|integer',
    'fecha_solicitud' => 'required|date',
    'resolucion_beneficio' => 'required|integer',
    'no_oficio_beneficio' => 'required|string|max:50',
    'oficio_beneficio' => 'required|string|max:300',
    'readonly' => 'required|integer',
  ];

  /**
   *Relaciones Eloquent
   */

  public function proceso()
  {
    return $this->belongsTo(Proceso::class, "proceso_id", "id");
  }

  public function ejecucion()
  {
    return $this->belongsTo(Ejecucion::class, "ejecucion_id", "id");
  }

  public function beneficioSolicitado()
  {
    return $this->hasOne(BeneficioSolicitado::class, "id", "beneficio_solicitado_id");
  }

  public function reparacionDanioMulta()
  {
    return $this->hasOne(ReparacionDanioMulta::class, "id", "reparacion_danio_multa_id");
  }

  public function resolucionBeneficio()
  {
    return $this->belongsTo(ResolucionBeneficio::class, "resolucion_beneficio_id", "id");
  }

  /**
   *Scopes
   */

  public function scopePorExpediente($query, $id_expediente)
  {
    return $query->join('procesos', 'procesos.id', "beneficios.proceso_id")
      ->where("procesos.expediente_id", "=", $id_expediente)
      ->select("beneficios.*");
  }

  public function scopeConcedido($query)
  {
    return $query->where("resolucion_beneficio_id", "=", 1135);
  }

  public function scopeNoConcedido($query)
  {
    return $query->where("resolucion_beneficio_id", "<>", 1135);
  }

  public function scopeSinResolucion($query)
  {
    return $query->whereNull("resolucion_beneficio_id");
  }

  public function scopeActivo($query)
  {
    return $query->whereNull("resolucion_beneficio_id")
      ->orWhere("resolucion_beneficio_id", "=", 1135); //La resolución del beneficio fue "Concedido"
  }

  /**
   *Atributos
   */

  public function getEstatusAttribute()
  {
    if (!$this->resolucion_beneficio_id || $this->resolucion_beneficio_id == 1135) {
      return "Activo";
    }
    return "Inactivo";
  }
  public function getFechaSolicitudFormatAttribute()
  {
    $date = date_create($this->fecha_solicitud);
    return date_format($date, "d/m/Y");
  }

  public function getFechaResolucionFormatAttribute()
  {
    if ($this->fecha_resolucion) {
      $date = date_create($this->fecha_resolucion);
      return date_format($date, "d/m/Y");
    }
    return null;
  }

  public function getAplicaLibertadPreparatoriaAttribute()
  {
    if (
      !$this->ejecucion->tiene_delitos_delincuencia_organizada
      && $this->ejecucion->porcentaje_cumplido_sentencia > 70
      && $this->ejecucion->proceso->sistema_penal != 1048 // 1048 sistema penal acusatorio
    ) {
      return true;
    }
    return false;
  }

  public function getAplicaLibertadAnticipadaAttribute()
  {
    if (
      !$this->ejecucion->tiene_delitos_delincuencia_organizada
      && $this->ejecucion->cantidad_otros_procesos_medida_oficiosa == 0
      && (($this->ejecucion->porcentaje_cumplido_sentencia > 70 && $this->tiene_delito_doloso)
        || ($this->ejecucion->porcentaje_cumplido_sentencia > 50 && !$this->tiene_delito_doloso))
    ) {
      return true;
    }
    return false;
  }

  public function getAplicaLibertadCondicionalAttribute()
  {
    if (
      !$this->ejecucion->tiene_delitos_delincuencia_organizada
      && !$this->ejecucion->tiene_otros_procesos_con_prision_preventiva
      && $this->ejecucion->tiene_delito_doloso
      && $this->ejecucion->porcentaje_cumplido_sentencia > 50
    ) {
      return true;
    }
    return false;
  }

  /**
   *Otros Métodos
   */
  public function beneficio_solicitado()
  {
    return $this->flex();
  }

  public function reparacion_danio_multa()
  {
    return $this->flex();
  }

  public function resolucion_beneficio()
  {
    return $this->flex();
  }
}
