<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Sipf\ModelosBase\Models\CatalogosFlexFields\Circuito;
use Sipf\ModelosBase\Models\CatalogosFlexFields\AutoridadJudicial;

class Ejecucion extends Model
{
  use HasFactory;
  use SoftDeletes;

  protected $table = 'ejecuciones';

  protected $fillable = [
    'id',
    'proceso_id',
    'fuero',
    'circuito_id',
    'circuito_estado_id',
    'num_exp_eje',
    'sipe',
    'autoridad_judicial_id',
    'autoridad_judicial_otro',
    'fecha_a_partir_de',
    'preventiva_anios',
    'preventiva_meses',
    'preventiva_dias',
    'punitiva_anios',
    'punitiva_meses',
    'punitiva_dias',
    'fecha_probable_compurga',
    'ruta_oficio',
    'readonly',
    'observacion_ejecucion'
  ];

  public $rules = [

    'proceso_id' => 'required|integer',
    'autoridad_judicial' => 'required|integer',
    'fecha_a_partir_de' => 'required|date',
    'preventiva_anios' => 'required|string|max:3',
    'preventiva_meses' => 'required|string|max:3',
    'preventiva_dias' => 'required|string|max:3',

    'punitiva_anios' => 'required|string|max:3',
    'punitiva_meses' => 'required|string|max:3',
    'punitiva_dias' => 'required|string|max:3',

    'fecha_probable_compurga' => 'required|date',

  ];

  /**
   *Relaciones Eloquent
   */

  public function proceso()
  {
    return $this->belongsTo(Proceso::class);
  }

  public function beneficios()
  {
    return $this->hasMany(Beneficio::class, "proceso_id", "proceso_id");
  }

  public function sentencia()
  {
    return $this->hasOne(Sentencia::class, "proceso_id", "proceso_id");
  }

  public function procesoPena()
  {
    return $this->hasOne(ProcesoPena::class, "proceso_id", "proceso_id");
  }

  public function beneficioActivo()
  {
    return $this->hasOne(Beneficio::class, "proceso_id", "proceso_id")->activo();
  }

  public function ultimoBeneficio()
  {
    return $this->hasOne(Beneficio::class, "proceso_id", "proceso_id")->latest();
  }

  public function ultimoBeneficioRechzado()
  {
    return $this->hasOne(Beneficio::class, "proceso_id", "proceso_id")->noConcedido()->latest();
  }

  public function autoridadJudicial()
  {
    return $this->belongsTo(AutoridadJudicial::class, "autoridad_judicial_id", "id");
  }

  public function circuito()
  {
    return $this->belongsTo(Circuito::class, "circuito_id", "id");
  }

  /**
   *Scopes
   */

  public function scopePorExpediente($query, $id_expediente)
  {
    return $query->join('procesos', 'procesos.id', "ejecuciones.proceso_id")
      ->where("procesos.expediente_id", "=", $id_expediente)
      ->select("ejecuciones.*");
  }

  public function scopePorExpedienteProcesoActivo($query, $id_expediente)
  {
    return $query->join('procesos', 'procesos.id', "ejecuciones.proceso_id")
      ->where("procesos.expediente_id", "=", $id_expediente)
      ->whereIn("procesos.proceso_clasificacion", [1055, 1054])
      ->select("ejecuciones.*");
  }

  public function scopeUltima($query)
  {
    return $query->latest('updated_at')->take(1);
  }

  /**
   *Atributos
   */

  public function getTemporalidadCompurgadaAttribute()
  {
    return "Años: " . $this->procesoPena->anio . " Meses: " . $this->procesoPena->mes . " Días: " . $this->procesoPena->dias;
  }

  public function getTieneBeneficioActivoTxtAttribute()
  {
    if ($this->beneficioActivo) {
      if ($this->beneficioActivo->resolucionBeneficio) {
        return "Si (" . $this->beneficioActivo->resolucionBeneficio?->description . ")";
      } else {
        return "Si (Resolución Pendiente)";
      }
    }
    return "No";
  }

  public function getTieneBeneficioActivoAttribute()
  {
    return $this->beneficioActivo ? true : false;
  }

  public function getPorcentajeCumplidoSentenciaAttribute()
  {
    $dias_transcurridos = $this->sentencia->dias_transcurridos;
    $dias_sentencia = $this->procesoPena->dias_sentencia;
    if ($dias_sentencia > 0) {
      return (int) floor($dias_transcurridos * 100 / $dias_sentencia);
    } else {
      return 0;
    }
  }

  public function getTieneOtrasSentenciasAttribute()
  {
    $otros_procesos = Proceso::where("expediente_id", "=", $this->proceso->expediente_id)
      ->where("id", "!=", $this->proceso_id)->pluck("id")->toArray();
    $cantidad_otras_sentencias = Sentencia::whereIn("proceso_id", $otros_procesos)
      ->get()->count();

    return $cantidad_otras_sentencias > 0 ?  true : false;
  }

  public function getCantidadOtrosProcesosMedidaOficiosaAttribute()
  {
    $no_procesos_medida_oficiosa = Proceso::medidaOficiosa()->where("expediente_id", "=", $this->proceso->expediente_id)
      ->where("id", "!=", $this->proceso_id)
      ->get()->count();
    return $no_procesos_medida_oficiosa;
  }

  public function getTieneOtrosProcesosMedidaOficiosaAttribute()
  {
    $cantidad_otros_procesos_medida_oficiosa = $this->cantidad_otros_procesos_medida_oficiosa;
    return $cantidad_otros_procesos_medida_oficiosa > 0 ?  true : false;
  }

  public function getCantidadOtrosProcesosAttribute()
  {
    $no_procesos = Proceso::where("expediente_id", "=", $this->proceso->expediente_id)
      ->where("id", "!=", $this->proceso_id)
      ->get()->count();
    return $no_procesos;
  }

  public function getTieneOtrosProcesosAttribute()
  {
    $cantidad_otros_procesos = $this->cantidad_otros_procesos;
    return $cantidad_otros_procesos > 0 ?  true : false;
  }

  public function getCantidadOtrosProcesosConPrisionPreventivaAttribute()
  {
    $no_procesos = Proceso::where("expediente_id", "=", $this->proceso->expediente_id)
      ->where("id", "!=", $this->proceso_id)
      ->where(function ($query) {
        $query->whereNotNull("medida_cautelar")
          ->orWhere("medida_cautelar", ">", "0");
      })
      ->get()->count();
    return $no_procesos;
  }

  public function getTieneOtrosProcesosConPrisionPreventivaAttribute()
  {
    $cantidad_otros_procesos_con_prision_preventiva = $this->cantidad_otros_procesos_con_prision_preventiva;
    return $cantidad_otros_procesos_con_prision_preventiva > 0 ?  true : false;
  }

  public function getCantidadDelitosDolososAttribute()
  {
    $no_delitos_dolosos = $this->proceso->delitos()->doloso()->count();
    return $no_delitos_dolosos;
  }

  public function getTieneDelitoDolosoAttribute()
  {
    return $this->cantidad_delitos_dolosos > 0 ? true : false;
  }

  public function getCantidadDelitosDelincuenciaOrganizadaAttribute()
  {
    $procesos = Proceso::where("expediente_id", "=", $this->proceso->expediente_id)
      ->get();
    $no_delitos_delincuencia_organizada = 0;
    foreach ($procesos as $proceso) {
      $no_delitos_delincuencia_organizada += $proceso->delitos()->delincuenciaOrganizada()->count();
    }
    return $no_delitos_delincuencia_organizada;
  }

  public function getTieneDelitosDelincuenciaOrganizadaAttribute()
  {
    return $this->cantidad_delitos_delincuencia_organizada > 0 ? true : false;
  }

  public function getAplicaLibertadPreparatoriaAttribute()
  {
    if (
      !$this->tiene_delitos_delincuencia_organizada
      && $this->porcentaje_cumplido_sentencia > 70
      && $this->proceso->sistema_penal != 1048 // 1048 sistema penal acusatorio
      && !$this->tiene_beneficio_activo
    ) {
      return true;
    }
    return false;
  }

  public function getAplicaLibertadAnticipadaAttribute()
  {
    if (
      !$this->tiene_delitos_delincuencia_organizada
      && $this->cantidad_otros_procesos_medida_oficiosa == 0
      && !$this->tiene_beneficio_activo
      && (($this->porcentaje_cumplido_sentencia > 70 && $this->tiene_delito_doloso)
        || ($this->porcentaje_cumplido_sentencia > 50 && !$this->tiene_delito_doloso))
    ) {
      return true;
    }
    return false;
  }

  public function getAplicaLibertadCondicionalAttribute()
  {
    if (
      !$this->tiene_delitos_delincuencia_organizada
      && !$this->tiene_otros_procesos_con_prision_preventiva
      && $this->tiene_delito_doloso
      && $this->porcentaje_cumplido_sentencia > 50
      && !$this->tiene_beneficio_activo
    ) {
      return true;
    }
    return false;
  }

  public function getFechaIngresoExpedienteAttribute()
  {
    return $this->proceso->expediente->ultima_fecha_ingreso_sf;
  }

  public function getFechaHoraIngresoExpedienteAttribute()
  {
    return $this->proceso->expediente->ultima_fecha_hora_ingreso_sf;
  }

  /**
   *Otros Métodos
   */


  public function autoridad_judicial()
  {
    return $this->flex();
  }
}
