<?php

namespace Sipf\ModelosBase\Models\Tecnico\Seguridad\Resguardo;

use DateTime;
use DateTimeZone;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Sipf\ModelosBase\Models\CatalogosFlexFields\Parentesco;
use Sipf\ModelosBase\Models\CatalogosFlexFields\TipoEntrega;

class ResguardoEntrega extends ResguardoEntregaIncineracion
{
  use HasFactory;
  use SoftDeletes;

  protected $fillable = [
    "folio_resguardo_id",
    "group_id",
    "pathFileEI",
    "nameEntregaFile",
    "fecha_entrega",
    "hora_entrega",
    "tipo_entrega",
    "parentesco",
    "nombre_familiar_entrega",
    "descripcion_entrega",
    "entrega_a",
    "observaciones_entrega",
  ];

  protected static function boot()
  {
    parent::boot();

    self::addGlobalScope(function ($query) {
      return $query
        ->whereNotNull('fecha_entrega');
    });
  }

  /**
   * Relaciones eloquent
   */

  public function parentesco()
  {
    return $this->belongsTo(Parentesco::class, "parentesco_entrega");
  }
  public function tipo()
  {
    return $this->belongsTo(TipoEntrega::class, "tipo_entrega", "value");
  }

  public function pertenencias()
  {
    return $this->hasMany(ResguardoPertenenciaObjeto::class, 'ei_id', 'id')
      ->entregada();
  }

  /**
   *Atributos
   */

  public function getFechaFormatAttribute()
  {
    $date = new DateTime($this->fecha_entrega . " " . $this->hora_entrega);
    $date->setTimezone(new DateTimeZone('America/Mexico_City'));
    return $date->format('d/m/Y H:i');
  }

  public function getEntregaTxtAttribute()
  {
    if ($this->parentesco) {
      return $this->entrega_a . "\n Parentesco: " . ucfirst(strtolower($this->parentesco->description));
    }
    return $this->entrega_a;
  }

  /**
   *Otros Métodos
   */
}
