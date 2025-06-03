<?php

namespace Sipf\ModelosBase\Models\Ubicaciones;

use Sipf\ModelosBase\Models\Centro;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Sipf\ModelosBase\Models\Tecnico\Criminologia\UbicacionReubicacion;
use Sipf\ModelosBase\Models\Tecnico\Seguridad\PaseDeLista\ReglaDeAsignacion;

class CentroSeccion extends Model
{
  use HasFactory, SoftDeletes;
  /**
   * Summary of table
   * @var string
   */
  protected $table = 'centro_secciones';

  /**
   * Summary of fillable
   * @var array
   */
  protected $fillable = [
    'centro_id',
    'dormitorio_id',
    'modulo_id',
    'centros_lugar',
    'nombre'
  ];
  /*-------------------------------- RELACIONES ------------------------------*/
  /**
   * Funcion que retorna la relacion de la tabla centro_secciones con la tabla centro
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function centro()
  {
    return $this->belongsTo(Centro::class);
  }

  /**
   * Funcion que retorna la relacion de la tabla centro_secciones con la tabla centro_dormitorios
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function dormitorio()
  {
    return $this->belongsTo(CentroDormitorio::class);
  }

  /**
   * Funcion que retorna la relacion de la tabla centro_secciones con la tabla centro_modulos
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function modulo()
  {
    return $this->belongsTo(CentroModulo::class);
  }


  /**
   * Funcion que retorna la relacion de la tabla centro_secciones con la tabla centro_secciones
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function ubicaciones()
  {
    return $this->hasMany(UbicacionReubicacion::class, 'seccion_id');
  }

  /**
   * Relación muchos a muchos con ReglaDeAsignacion a través de la tabla pivote `regla_de_asignacion_seccion`
   */
  public function reglasDeAsignacion(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
  {
    return $this->belongsToMany(ReglaDeAsignacion::class, 'regla_de_asignacion_seccion', 'seccion_id', 'regla_de_asignacion_id');
  }

  /*------------------------------------------------------------------------*/
}
