<?php

namespace Sipf\ModelosBase\Models\Ubicaciones;

use Sipf\ModelosBase\Models\FFV;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Sipf\ModelosBase\Models\Centro;
use Sipf\ModelosBase\Models\Tecnico\Criminologia\UbicacionReubicacion;

class CentroDormitorio extends FFV
{
  use HasFactory, SoftDeletes;

  /**
   * Summary of table
   * @var string
   */
  protected $table = 'centro_dormitorios';

  /**
   * Summary of fillable
   * @var array
   */
  protected $fillable = [
    'centro_id',
    'centros_lugar',
    'nombre',
  ];

  /*-------------------------------- RELACIONES ------------------------------*/

  /**
   * Funcion que retorna la relacion de la tabla centro_camas con la tabla centro_dormitorios
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function centro()
  {
    return $this->belongsTo(Centro::class);
  }

  public function secciones()
  {
    return $this->hasMany(CentroSeccion::class, 'dormitorio_id');
  }

  /**
   * Funcion que retorna la relacion de la tabla centro_camas con la tabla centro_secciones
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function ubicaciones()
  {
    return $this->hasMany(UbicacionReubicacion::class, 'dormitorio_id');
  }
  /*------------------------------------------------------------------------*/
}
