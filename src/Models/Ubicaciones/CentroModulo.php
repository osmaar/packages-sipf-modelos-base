<?php

namespace Sipf\ModelosBase\Models\Ubicaciones;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Sipf\ModelosBase\Models\Centro;
use Sipf\ModelosBase\Models\Tecnico\Criminologia\UbicacionReubicacion;

class CentroModulo extends Model
{
  use HasFactory, SoftDeletes;

  /**
   * Summary of table
   * @var array
   */
  protected $table = 'centro_modulos';

  /**
   * Summary of fillable
   * @var array
   */
  protected $fillable = [
    'centro_id',
    'dormitorio_id',
    'centros_lugar',
    'nombre',
  ];

  /*-------------------------------- RELACIONES ------------------------------*/
  /**
   * Funcion que retorna la relacion de la tabla centro_modulos con la tabla centro
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function centro()
  {
    return $this->belongsTo(Centro::class, 'centro_id');
  }

  /**
   * Funcion que retorna la relacion de la tabla centro_modulos con la tabla centro_dormitorios
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function dormitorio()
  {
    return $this->belongsTo(CentroDormitorio::class, 'dormitorio_id');
  }

  /**
   * Funcion que retorna la relacion de la tabla centro_modulos con la tabla centro_secciones
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function secciones()
  {
    return $this->hasMany(CentroSeccion::class, 'modulo_id');
  }

  /**
   * Funcion que retorna la relacion de la tabla centro_modulos con la tabla centro_secciones
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function ubicaciones()
  {
    return $this->hasMany(UbicacionReubicacion::class, 'modulo_id');
  }
}
