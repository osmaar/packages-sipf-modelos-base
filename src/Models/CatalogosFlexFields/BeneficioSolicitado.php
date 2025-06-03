<?php

namespace Sipf\ModelosBase\Models\CatalogosFlexFields;

use Sipf\ModelosBase\Models\FlexfieldValue;

class BeneficioSolicitado extends FlexfieldValue
{
  protected $table = 'flexfield_values';

  public const CONDICIONADA_ID = 1129;
  public const ANTICIPADA_ID = 1130;
  public const PREPARATORIA_ID = 1132;

  protected static function boot()
  {
    parent::boot();

    self::addGlobalScope(function ($query) {
      return $query->where('flexfield_id', '=', 84);
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
