<?php

namespace Sipf\ModelosBase\Models\CatalogosFlexFields;

use Sipf\ModelosBase\Models\FlexfieldValue;

class Etnia extends FlexfieldValue
{
  protected $table = 'flexfield_values';

  protected static function boot()
  {
    parent::boot();

    self::addGlobalScope(function ($query) {
      return $query->where('flexfield_id', '=', 8);
    });
  }
}
