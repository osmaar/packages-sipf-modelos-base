<?php

namespace Sipf\ModelosBase\Models\DireccionGeneral\Correspondencia;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Sipf\ModelosBase\Models\CatalogosFlexFields\TipoObjeto;
use Sipf\ModelosBase\Models\CatalogosFlexFields\EstadoResguardo;
use Sipf\ModelosBase\Models\Tecnico\Seguridad\Resguardo\ResguardoFolio;
use Sipf\ModelosBase\Models\Tecnico\Seguridad\Resguardo\ObservacionesFormatoDesglosado;

class RecepcionCorrespondenciaEntrega extends Model
{
  use HasFactory;
  use SoftDeletes;
  use ObservacionesFormatoDesglosado;

  protected $table = "recepcion_correspondencia_entregas";
  protected $fillable = [
    "recepcion_correspondencia_id",
    "group_id",
    "pathFile",
    "nameFile",
    "fecha",
    "hora",
    "tipo",
    "observaciones",
    "fecha_devolucion_inicial",
    "fecha_devolucion_real",
    "hora_devolucion",
    "observaciones_devolucion",

  ];

  /**
   *Relaciones Eloquent
   */
  public function tipo()
  {
    return $this->flex();
  }

  public function catalogos()
  {
    return $this->hasMany(RecepcionCorrespondenciaObjeto::class, 'folio_recepcion_correspondencia');
  }

  public function folio()
  {
    return $this->belongsTo(ResguardoFolio::class, 'folio_recepcion_correspondencia', 'id');
  }

  public function dineros()
  {
    return $this->hasMany(RecepcionCorrespondenciaObjetoDinero::class, 'recepcion_correspondencia_objeto_id', 'id');
  }

  public function tipoObjeto()
  {
    return $this->belongsTo(TipoObjeto::class, "id_tipo_objeto", "value");
  }

  public function estadoResguardo()
  {
    return $this->belongsTo(EstadoResguardo::class, "id_estado_resguardo", "value");
  }

  /**
   *Scopes
   */

  public function scopePorRecepcionCorrespondencia($query, $folio_recepcion_correspondencia)
  {
    return $query->where("folio_recepcion_correspondencia", "=", $folio_recepcion_correspondencia);
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
