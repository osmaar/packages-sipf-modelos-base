<?php

namespace Sipf\ModelosBase\Models\Tecnico\Seguridad\Resguardo;

use DateTime;
use DateTimeZone;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ResguardoIncineracion extends ResguardoEntregaIncineracion
{
  use HasFactory;
  use SoftDeletes;

  protected $fillable = [
    "folio_resguardo_id",
    "group_id",
    "pathFileEI",
    "nameIncineracionFile",
    "fecha_incineracion",
    "hora_incineracion",
    "realiza_incineracion",
    "autoriza_incineracion",
    "observaciones_incineracion"
  ];

  protected static function boot()
  {
    parent::boot();

    self::addGlobalScope(function ($query) {
      return $query
        ->whereNotNull('fecha_incineracion');
    });
  }

  public function pertenencias()
  {
    return $this->hasMany(ResguardoPertenenciaObjeto::class, 'ei_id', 'id')
      ->incinerada();
  }

  /**
   *Atributos
   */

  public function getFechaFormatAttribute()
  {
    $date = new DateTime($this->fecha_incineracion . " " . $this->hora_incineracion);
    $date->setTimezone(new DateTimeZone('America/Mexico_City'));
    return $date->format('d/m/Y H:i');
  }

  /**
   *Otros Métodos
   */
}
