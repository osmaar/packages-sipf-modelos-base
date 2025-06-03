<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * crea la clase en donde se alamacenar las huellas del familar
 *
 */
class SeniaHuellaFamiliar extends Model
{
  use HasFactory;
  use SoftDeletes;

  protected $table = 'senias_huellas_familiar';

  /**
   * obtiene el catalogo de las extremidades de situación especial
   *
   * @return void
   */
  public function extremidad_situacion_especial()
  {
    return $this->flex();
  }

  public function familiares()
  {
    return $this->belongsTo(Referencia::class);
  }
}
