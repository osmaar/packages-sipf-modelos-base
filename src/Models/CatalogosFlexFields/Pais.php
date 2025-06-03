<?php

namespace Sipf\ModelosBase\Models\CatalogosFlexFields;

use Sipf\ModelosBase\Models\FlexfieldValue;

class Pais extends FlexfieldValue
{
  protected $table = 'flexfield_values';

  protected static function boot()
  {
    parent::boot();

    self::addGlobalScope(function ($query) {
      return $query->where('flexfield_id', '=', 1);
    });
  }

  public function getMonedaAttribute()
  {
    if ($this->aux_2 != "") {
      return "Moneda de " . ucwords(mb_strtolower($this->description)) . " (" . $this->aux_2 . ")";
    } else {
      return "Moneda de " . ucwords(mb_strtolower($this->description));
    }
  }
}
