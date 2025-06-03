<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CorrespondenciaCaracteristica extends Model
{
  use HasFactory;

  protected $table = 'correspondencia_caracteristicas';

  protected $fillable = [
    'nombre',
  ];

  /**
   * Obtiene el catalogo de caracteristicas de correspondencia
   * @return \Illuminate\Database\Eloquent\Collection
   */
  public static function catCaracteristicas(): \Illuminate\Database\Eloquent\Collection
  {
    return self::select('id', 'nombre')->get() ?? collect();
  }
}
