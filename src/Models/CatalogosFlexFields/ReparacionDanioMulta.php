<?php

namespace Sipf\ModelosBase\Models\CatalogosFlexFields;

use Sipf\ModelosBase\Models\FlexfieldValue;

class ReparacionDanioMulta extends FlexfieldValue
{
  protected $table = 'flexfield_values';
  public const CUBIERTA_ID = 1133;

  protected static function boot()
  {
    parent::boot();

    self::addGlobalScope(function ($query) {
      return $query->where('flexfield_id', '=', 85);
    });
  }
}
