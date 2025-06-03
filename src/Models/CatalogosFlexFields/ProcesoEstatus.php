<?php

namespace Sipf\ModelosBase\Models\CatalogosFlexFields;

use Sipf\ModelosBase\Models\FlexfieldValue;

class ProcesoEstatus extends FlexfieldValue
{
  protected $table = 'flexfield_values';
  public const ACTUAL_ID = 1049;

  protected static function boot()
  {
    parent::boot();

    self::addGlobalScope(function ($query) {
      return $query->where('flexfield_id', '=', 63);
    });
  }
}
