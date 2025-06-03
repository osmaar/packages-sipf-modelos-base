<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Sipf\ModelosBase\Models\CatalogosFlexFields\AutoridadJudicial;
use Sipf\ModelosBase\Models\CatalogosFlexFields\ProcesoClasificacion;
use Sipf\ModelosBase\Models\CatalogosFlexFields\SistemaPenal;

/**
 * Clase proceso del modelo
 */
class Proceso extends FFV
{
  protected $table = 'procesos';
  use HasFactory;
  use SoftDeletes;

  //Datos que se van a llenar en la base de datos.
  protected $fillable = [
    'id',
    'expediente_id',
    'sistema_penal',
    'causa_penal',
    'sipe',
    'extradicion',
    'pais',
    'procedimiento_extradicion',
    'cargo',
    'proceso_estatus',
    'proceso_clasificacion',
    'fuero',
    'circuito_id',
    'estado_id',
    'autoridad_judicial_id',
    'autoridad_judicial_otro',
    'declinacion_competencia',
    'fecha_declinacion',
    'motivo_declinacion',
    'tipo_declinacion',
    'observacion_declinacion',
    'medida_cautelar',
    'fecha_radicacion',
    'tipo_comision',
    'observacion_proceso',
    'estatus',
    'estatus_libertad',
    'readonly',
    'ruta_oficio',
    'fecha_hora'
  ];
  protected $dates = ['deleted_at'];
  public static $rules = [
    'id' => 'integer',
    'expediente_id' => 'required|integer',
    'sistema_penal' => 'integer',
    'causa_penal' => 'string|max:30',
    'sipe' => 'string|max:70',
    'extradicion' => 'in:Si,No',
    'procedimiento_extradicion' => 'string|max:70',
    'cargo' => 'string|max:70',
    'proceso_clasificacion' => 'integer',
    'fuero' => 'integer',
    'circuito_id' => 'integer',
    'estado_id' => 'integer',
    'autoridad_judicial_id' => 'integer',
    'autoridad_judicial_otro' => 'string',
    'declinacion_competencia' => 'in:Si,No',
    'fecha_declinacion' => 'date',
    'motivo_declinacion' => 'integer',
    'tipo_declinacion' => 'in:Parcial,Total',
    'medida_cautelar' => 'integer',
    'fecha_radicacion' => 'date',
  ];

  /**
   *Relaciones Eloquent
   */

  public function sistemaPenal()
  {
    return $this->belongsTo(SistemaPenal::class, "sistema_penal", "id");
  }


  public function procesoEstatus()
  {
    return $this->flex();
  }

  public function procesoClasificacionFlex()
  {
    return $this->flex();
  }

  public function procesoClasificacion()
  {
    return $this->belongsTo(ProcesoClasificacion::class, "proceso_clasificacion", "id");
  }

  public function fuero()
  {
    return $this->flex();
  }

  public function medidaCautelar()
  {
    return $this->flex();
  }

  public function tipoComision()
  {
    return $this->flex();
  }

  public function autoridadJudicial()
  {
    return $this->belongsTo(AutoridadJudicial::class, "autoridad_judicial_id", "id");
  }

  public function autoridadesJudiciales()
  {
    return $this->hasMany(ProcesoAutoridadJudicial::class, "proceso_id", "id");
  }

  public function motivoDeclinacion()
  {
    return $this->flex();
  }

  public function procesosDelito()
  {
    return $this->hasMany(ProcesoDelito::class, 'proceso_id');
  }

  public function delitos()
  {
    return $this->hasMany(ProcesoDelito::class, 'proceso_id');
  }

  public function vinculacionCoacusado()
  {
    return $this->hasMany(VinculacionCoacusado::class, 'vinculacion_id');
  }

  public function procesosDelitoExtradicion()
  {
    return $this->hasMany(ProcesoDelitoExtradicion::class, 'proceso_id');
  }

  public function porocesoPena()
  {
    return $this->hasOne(ProcesoPena::class, 'id');
  }

  public function vinculacion()
  {
    return $this->hasOne(Vinculacion::class, 'id');
  }

  public function sentencia()
  {
    return $this->hasOne(Sentencia::class);
  }

  public function apelacion()
  {
    return $this->hasOne(Apelacion::class, 'proceso_id');
  }

  public function amparo()
  {
    return $this->hasOne(Amparo::class, 'proceso_id');
  }

  public function revision()
  {
    //return ;
    return $this->hasOne(RecursoRevision::class, 'proceso_id');
  }

  public function antecedente()
  {
    return $this->hasOne(Antecedente::class, 'expediente_id');
  }

  public function ejecuciones()
  {
    return $this->hasMany(Ejecucion::class, 'proceso_id');
  }

  public function ultimaEjecucion()
  {
    return $this->hasOne(Ejecucion::class, 'proceso_id')->ultima();
  }

  public function modificaciones()
  {
    return $this->hasMany(Modificacion::class, 'proceso_id');
  }

  public function libertad()
  {
    return $this->hasOne(Libertad::class, 'proceso_id');
  }

  public function libertadActiva()
  {
    return $this->hasOne(Libertad::class, 'proceso_id')->activa();
  }

  public function beneficio()
  {
    return $this->hasOne(Beneficio::class, 'proceso_id');
  }

  public function beneficios()
  {
    return $this->hasMany(Beneficio::class, 'proceso_id');
  }

  public function detalles()
  {
    return $this->hasMany(ProcesoAcumulacionDetalle::class, 'proceso_id');
  }

  public function procesoAcumulacionDetalle()
  {
    return $this->hasMany(ProcesoAcumulacionDetalle::class, 'proceso_id');
  }

  public function expediente()
  {
    return $this->belongsTo(Expediente::class);
  }

  public function procesoPena()
  {
    return $this->hasOne(ProcesoPena::class, 'proceso_id');
  }

  public function procesoAutoridadJudicial()
  {
    return $this->hasMany(ProcesoAutoridadJudicial::class, 'proceso_id');
  }

  public function sistema_penal()
  {
    return $this->flex();
  }

  public function proceso_estatus()
  {
    return $this->flex();
  }

  public function proceso_clasificacion()
  {
    return $this->flex();
  }

  public function medida_cautelar()
  {
    return $this->flex();
  }

  public function tipo_comision()
  {
    return $this->flex();
  }

  public function autoridad_judicial()
  {
    return $this->flex();
  }

  public function motivo_declinacion()
  {
    return $this->flex();
  }

  public function procesoDelito()
  {
    return $this->hasMany(ProcesoDelito::class, 'proceso_id');
  }

  public function vinculacion_coacusado()
  {
    return $this->hasMany(VinculacionCoacusado::class, 'vinculacion_id');
  }

  public function proceso_delito()
  {
    return $this->hasMany(ProcesoDelito::class, 'proceso_id');
  }

  public function proceso_delito_extradicion()
  {
    return $this->hasMany(ProcesoDelitoExtradicion::class, 'proceso_id');
  }

  public function poroceso_pena()
  {
    return $this->hasOne(ProcesoPena::class, 'id');
  }

  public function antecedentes()
  {
    return $this->hasOne(Antecedente::class, 'expediente_id');
  }

  public function ejecucion()
  {
    return $this->hasMany(Ejecucion::class, 'proceso_id');
  }

  public function modificacion()
  {
    return $this->hasMany(Modificacion::class, 'proceso_id');
  }

  public function proceso_acumulacion_detalle()
  {
    return $this->hasMany(ProcesoAcumulacionDetalle::class, 'proceso_id');
  }

  public function proceso_pena()
  {
    return $this->hasOne(ProcesoPena::class, 'proceso_id');
  }

  public function proceso_autoridad_judicial()
  {
    return $this->hasMany(ProcesoAutoridadJudicial::class, 'proceso_id');
  }

  public function scopeActual($query)
  {
    return $query->whereIn('procesos.estatus', ['actual']);
  }

  public function scopeActivo($query)
  {
    return $query->whereIn('procesos.estatus', ['actual', 'pendiente']);
  }

  public function scopeMedidaOficiosa($query)
  {
    return $query->where("medida_cautelar", "=", 1171);
  }

  public function scopePorExpedienteProcesoActivo($query, $id_expediente)
  {
    return $query
      ->where("procesos.expediente_id", "=", $id_expediente)
      ->whereIn('procesos.estatus', ['actual', 'pendiente', 'concluido']);
  }

  public function scopeNoActualNoPendiente($query)
  {
    return $query
      ->whereNotIn('estatus', ['actual', 'pendiente']);
  }

  public function scopeActualPendiente($query)
  {
    return $query
      ->whereIn('estatus', ['actual', 'pendiente']);
  }

  public function scopeVigente($query, $fecha_ingreso)
  {
    return $query->where("fecha_hora", ">=", $fecha_ingreso);
  }

  public function getBeneficiosSolicitadosTxtAttribute()
  {
    $beneficios_txt = null;
    $beneficios_arr = [];

    foreach ($this->beneficios as $beneficio) {
      $beneficios_arr[] = $beneficio->beneficioSolicitado->description;
    }

    $beneficios_arr = array_unique($beneficios_arr);

    if (count($beneficios_arr) > 0) $beneficios_txt = implode(", ", $beneficios_arr);

    return $beneficios_txt;
  }

  public function getBeneficiosConcedidosSolicitadosTxtAttribute()
  {
    $beneficios_txt = null;
    $beneficios_arr = [];

    foreach ($this->beneficios()->concedido()->get() as $beneficio) {
      $beneficios_arr[] = $beneficio->beneficioSolicitado->description;
    }

    $beneficios_arr = array_unique($beneficios_arr);

    if (count($beneficios_arr) > 0) $beneficios_txt = implode(", ", $beneficios_arr);

    return $beneficios_txt;
  }

  /**
   *Otros Métodos
   */

  public function setConcluidoPorLiberacion()
  {
    try {
      $this->fecha_vinculacion = null;
      $this->fecha_sentencia_eje = null;
      $this->proceso_estatus = 1;
      $this->estatus = "concluido";
      $this->proceso_clasificacion = 1057;
      $this->estatus_libertad = "liberado";
      $this->save();
    } catch (\Exception $e) {
      throw new \Exception("Hubo un error al concluir el proceso: " . $e->getMessage());
    }
  }

  public function setActual()
  {
    try {
      $this->estatus = "actual";
      $this->proceso_estatus = 1;
      $this->save();
    } catch (\Exception $e) {
      throw new \Exception("Hubo un error al establecer el proceso como actual: " . $e->getMessage());
    }
  }

  public function setPendiente()
  {
    try {
      $this->estatus = "pendiente";
      $this->proceso_estatus = 2;
      $this->save();
    } catch (\Exception $e) {
      throw new \Exception("Hubo un error al establecer el proceso como pendiente: " . $e->getMessage());
    }
  }
}
