<?php

namespace Sipf\ModelosBase\Models\CatalogosFlexFields;

use Sipf\ModelosBase\Models\FlexfieldValue;

class ResolucionBeneficio extends FlexfieldValue
{
  protected $table = 'flexfield_values';
  public const CONCEDIDO_ID = 1135;

  protected static function boot()
  {
    parent::boot();

    self::addGlobalScope(function ($query) {
      return $query->where('flexfield_id', '=', 86);
    });
  }
}
