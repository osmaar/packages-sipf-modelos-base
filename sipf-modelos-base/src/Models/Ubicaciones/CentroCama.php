<?php

namespace Sipf\ModelosBase\Models\Ubicaciones;

use Sipf\ModelosBase\Models\Centro;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Sipf\ModelosBase\Models\Tecnico\Criminologia\UbicacionReubicacion;

class CentroCama extends Model
{
  use HasFactory, SoftDeletes;

  /**
   * Summary of table
   * @var string
   */
  protected $table = 'centro_camas';

  /**
   * Summary of fillable
   * @var array
   */
  protected $fillable = [
    'centro_id',
    'dormitorio_id',
    'modulo_id',
    'seccion_id',
    'estancia_id',
    'centros_lugar',
    'nombre',
  ];

  /*------------------------------------------------------------------------*/

  /*-------------------------------- RELACIONES ------------------------------*/

  /**
   * Función que retorna la relación de la tabla centro_camas con la tabla centro_dormitorios
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function centro()
  {
    return $this->belongsTo(Centro::class);
  }

  /**
   * Función que retorna la relación de la tabla centro_camas con la tabla centro_dormitorios
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function dormitorio()
  {
    return $this->belongsTo(CentroDormitorio::class);
  }

  /**
   * Función que retorna la relación de la tabla centro_camas con la tabla centro_modulos
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function modulo()
  {
    return $this->belongsTo(CentroModulo::class);
  }

  /**
   * Función que retorna la relación de la tabla centro_camas con la tabla centro_secciones
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function seccion()
  {
    return $this->belongsTo(CentroEstancia::class);
  }

  /**
   * Función que retorna la relación de la tabla centro_camas con la tabla centro_estancias
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function estancia()
  {
    return $this->belongsTo(CentroEstancia::class);
  }
  /**
   * Función que retorna la relación de la tabla centro_camas con la tabla ubicacion_reubicaciones
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function ubicaciones()
  {
    return $this->hasMany(UbicacionReubicacion::class);
  }
  /*------------------------------------------------------------------------*/
}
