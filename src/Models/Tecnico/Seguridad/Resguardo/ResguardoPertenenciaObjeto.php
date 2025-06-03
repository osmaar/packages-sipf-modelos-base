<?php

namespace Sipf\ModelosBase\Models\Tecnico\Seguridad\Resguardo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Sipf\ModelosBase\Models\CatalogosFlexFields\TipoObjeto;
use Sipf\ModelosBase\Models\CatalogosFlexFields\EstadoResguardo;
use Sipf\ModelosBase\Models\DireccionGeneral\Correspondencia\RecepcionCorrespondenciaObjeto;

class ResguardoPertenenciaObjeto extends Model
{
  use HasFactory;
  use SoftDeletes;
  use ObservacionesFormatoDesglosado;

  protected $table = "resguardo_pertenencias_objetos";
  protected $fillable = [
    "folio_resguardo_id",
    "id_tipo_objeto",
    "descripcion_objeto",
    "id_estado_resguardo",
    "valor_objeto",
    "observaciones",
    "estatus",
    "disabled",
    "fecha_resguardo",
    "hora_resguardo",
    "tipo_equipo_electronico",
    "recepcion_correspondencia_objeto_id",
    "marca",
    "color"

    // ############  F I L E S

    // "pathPdfPertenenciasFirmado",
    // "namePdfPertenenciasFirmado",
    // "namePapeleta",
    // "nameIncineracion",

    // ############  E N T R E G A

    // "fecha_entrega",
    // "hora_entrega",
    // "tipo_entrega",
    // "parentesco_entrega",
    // "nombre_familiar",
    // "descripcion_entrega",
    // "entrega_a",
    // "observaciones_entrega",

    // ###########   I N C I N E R A C I O N
    // "fecha_incineracion",
    // "hora_incineracion",
    // "realiza_incineracion",
    // "autoriza_incineracion",
    // "observaciones_incineracion",
    // "close"
  ];

  public $rules = [
    "folio_resguardo_id" => 'required|integer',
    "tipo_objeto" => 'required|integer',
    "descripcion_objeto" => 'required|string|max:500',
    "estado_resguardo" => 'required|integer',
    "valor_objeto" => 'required|integer',
    "fecha_resguardo"  => 'required|date',
    "hora_resguardo" => "required|date_format:H:i:s",
  ];

  /**
   *Relaciones Eloquent
   */

  public function catalogos()
  {
    return $this->hasMany(ResguardoPertenenciaObjeto::class, 'folio_resguardo_id');
  }

  public function folio()
  {
    return $this->belongsTo(ResguardoFolio::class, 'folio_resguardo_id', 'id');
  }
  public function entregaIncineracion()
  {
    return $this->hasOne(ResguardoEntregaIncineracion::class, 'id', 'ei_id');
  }

  public function dineros()
  {
    return $this->hasMany(ResguardoDinero::class, 'resguardo_pertenencia_objeto_id', 'id');
  }

  public function idGroup()
  {
    return $this->belongsTo(ResguardoEntregaIncineracion::class, 'group_id', 'idGroup');
  }

  public function tipoObjeto()
  {
    return $this->belongsTo(TipoObjeto::class, "id_tipo_objeto", "value");
  }

  public function estadoResguardo()
  {
    return $this->belongsTo(EstadoResguardo::class, "id_estado_resguardo", "value");
  }

  public function entregaIncineracion02()
  {
    return $this->belongsTo(ResguardoEntregaIncineracion::class, 'folio_resguardo_id', 'folio_resguardo_id')
      ->whereColumn('resguardo_pertenencias_objetos.idGroup', '=', 'resguardo_pertenencias_e_i.group_id');
  }

  public function recepcionCorrespondenciaObjeto()
  {
    return $this->belongsTo(RecepcionCorrespondenciaObjeto::class, 'recepcion_correspondencia_objeto_id');
  }

  /**
   *Scopes
   */

  public function scopePorFolioResguardo($query, $folio_resguardo_id)
  {
    return $query->where("folio_resguardo_id", "=", $folio_resguardo_id);
  }

  public function scopeEntregada($query)
  {
    return $query->where("estatus", "=", "entregado");
  }

  public function scopeIncinerada($query)
  {
    return $query->where("estatus", "=", "incinerado");
  }

  /**
   *Atributos
   */

  public function getDescripcionFormatoAttribute()
  {
    if ($this->id_tipo_objeto != 1) {
      return $this->descripcion_objeto;
    } else {
      $dinero_arr = $this->getArregloSumatoriasDinero();
      return implode("\n", $dinero_arr);
    }
  }

  public function getDescripcionFormatoHtmlAttribute()
  {
    if ($this->id_tipo_objeto != 1) {
      return $this->descripcion_objeto;
    } else {
      $dinero_arr = $this->getArregloSumatoriasDinero();
      return implode("<br />", $dinero_arr);
    }
  }

  public function getObservacionesFormatoAttribute()
  {
    if ($this->id_tipo_objeto != 1) {
      return $this->observaciones;
    } else {
      $sumatoria = [];
      foreach ($this->dineros as $dinero) {
        if (key_exists($dinero->tipo_dinero, $sumatoria)) {
          $sumatoria[$dinero->tipo_dinero] += 1;
        } else {
          $sumatoria[$dinero->tipo_dinero] = 1;
        }
      }
      $dinero_arr = [];

      foreach ($sumatoria as $key => $value) {
        $dinero_arr[] = "Total de " . ucfirst(strtolower($key)) . ": " . number_format($value, 0);
      }
      return implode("\n", $dinero_arr);
    }
  }

  /**
   *Otros Métodos
   */

  public function getArregloSumatoriasDinero()
  {

    $sumatoria = [];
    foreach ($this->dineros as $dinero) {
      if (key_exists($dinero->pais->moneda, $sumatoria)) {
        $sumatoria[$dinero->pais->moneda] += ($dinero->valor_dinero * $dinero->cantidad);
      } else {
        $sumatoria[$dinero->pais->moneda] = ($dinero->valor_dinero * $dinero->cantidad);
      }
    }
    $dinero_arr = [];

    foreach ($sumatoria as $key => $value) {
      $dinero_arr[] = "Total en " . $key . ": $" . number_format($value, 2);
    }

    return $dinero_arr;
  }
}
