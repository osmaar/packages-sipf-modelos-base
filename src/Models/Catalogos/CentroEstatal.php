<?php

namespace Sipf\ModelosBase\Models\Catalogos;

use Illuminate\Database\Eloquent\Model;

class CentroEstatal extends Model
{
  protected $table = 'centros_estatales';

  public function scopePorEntidad($query, $entidad_id)
  {
    return $query->where('entidad_federativa', '=', $entidad_id);
  }

  public function scopePorTipo($query, $tipo)
  {
    return $query->where('tipo', '=', $tipo);
  }
}
