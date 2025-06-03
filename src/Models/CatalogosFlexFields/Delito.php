<?php

namespace Sipf\ModelosBase\Models\CatalogosFlexFields;

use Sipf\ModelosBase\Models\FlexfieldValue;

class Delito extends FlexfieldValue
{
  protected $table = 'flexfield_values';

  public const DELINCUENCIA_ORGANIZADA = 2360;

  protected static function boot()
  {
    parent::boot();

    self::addGlobalScope(function ($query) {
      return $query->where('flexfield_id', '=', 138);
    });
  }

  public function scopeCondicionada($query)
  {
    return $query->where("value", "=", 1);
  }
  public function scopeAnticipada($query)
  {
    return $query->where("value", "=", 2);
  }

  public function scopeRpp($query)
  {
    return $query->where("value", "=", 3);
  }

  public function scopePreparatoria($query)
  {
    return $query->where("value", "=", 4);
  }
}
