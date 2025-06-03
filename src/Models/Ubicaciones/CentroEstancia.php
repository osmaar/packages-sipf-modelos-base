<?php

namespace Sipf\ModelosBase\Models\Ubicaciones;

use Sipf\ModelosBase\Models\Centro;
use Sipf\ModelosBase\Models\Persona;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Sipf\ModelosBase\Models\Tecnico\Criminologia\UbicacionReubicacion;

class CentroEstancia extends Model
{
  use HasFactory, SoftDeletes;

  /**
   * Summary of table
   * @var string
   */
  protected $table = "centro_estancias";

  /**
   * Summary of fillable
   * @var array
   */
  protected $fillable = [
    'centro_id',
    'dormitorio_id',
    'modulo_id',
    'seccion_id',
    'centros_lugar',
    'centros_tipo_estancia',
    'nombre',
    'tipo',
    'capacidad',
    'ocupados',
    'estatus',
  ];

  /**
   * Summary of casts
   * @var array
   */
  protected $casts = [
    'capacidad' => 'integer',
    'ocupados' => 'integer',
    'estatus' => 'integer',
  ];


  /*-------------------------------- SCOPES ------------------------------*/
  /**
   * Sirve para filtrar los analisis de riesgo por persona
   * @param mixed $query
   * @param mixed $persona_id
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopeDePersona($query, $persona_id): \Illuminate\Database\Eloquent\Builder
  {
    return $query->where('persona_id', $persona_id);
  }
  /**
   * Scope para filtrar estancias disponibles
   *
   * @param \Illuminate\Database\Eloquent\Builder $query
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopeDisponible($query, $centro)
  {
    $ubicacionesTemporales = [4688, 4691, 4693, 4689, 4692, 4690, 4687];

    return $query->where(function ($query) use ($centro) {
      $query->where('centro_id', $centro)
        ->whereColumn('capacidad', '>', 'ocupados')
        ->where('estatus', 1);
    })->orWhere(function ($query) use ($ubicacionesTemporales) {
      $query->whereIn('centros_lugar', $ubicacionesTemporales)
        ->whereColumn('capacidad', '>', 'ocupados')
        ->where('estatus', 1);
    });
  }
  /*------------------------------------------------------------------------*/

  /*-------------------------------- RELACIONES ------------------------------*/
  /**
   * Función que retorna la relación de la tabla centro_estancias con la tabla ubicacion_reubicaciones
   * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
   */
  public function persona()
  {
    return $this->hasManyThrough(Persona::class, UbicacionReubicacion::class, 'estancia_id', 'id', 'id', 'persona_id')->distinct();
  }


  /**
   * Función que retorna la relación de la tabla centro_estancias con la tabla centro_dormitorios
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function centro()
  {
    return $this->belongsTo(Centro::class);
  }

  /**
   * Función que retorna la relación de la tabla centro_estancias con la tabla centro_dormitorios
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function dormitorio()
  {
    return $this->belongsTo(CentroDormitorio::class, 'dormitorio_id');
  }

  /**
   * Función que retorna la relación de la tabla centro_estancias con la tabla centro_modulos
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function modulo()
  {
    return $this->belongsTo(CentroModulo::class);
  }

  /**
   * Función que retorna la relación de la tabla centro_estancias con la tabla centro_secciones
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function seccion()
  {
    return $this->belongsTo(CentroSeccion::class);
  }

  /**
   * Función que retorna la relación de la tabla centro_estancias con la tabla ubicacion_reubicaciones
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function ubicaciones()
  {
    return $this->hasMany(UbicacionReubicacion::class, 'estancia_id');
  }

  /**
   * Función que retorna la relación de la tabla centro_estancias con la tabla centro_camas
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function camas()
  {
    return $this->hasMany(CentroCama::class, 'estancia_id');
  }
  /*------------------------------------------------------------------------*/
}
