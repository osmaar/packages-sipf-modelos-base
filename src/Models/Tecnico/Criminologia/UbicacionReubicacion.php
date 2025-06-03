<?php

namespace Sipf\ModelosBase\Models\Tecnico\Criminologia;

use Sipf\ModelosBase\Models\Centro;
use Sipf\ModelosBase\Models\Persona;
use Illuminate\Database\Eloquent\Model;
use Sipf\ModelosBase\Models\Ubicaciones\CentroCama;
use Sipf\ModelosBase\Models\Ubicaciones\CentroModulo;
use Sipf\ModelosBase\Models\Ubicaciones\CentroSeccion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Sipf\ModelosBase\Models\Ubicaciones\CentroEstancia;
use Sipf\ModelosBase\Models\Ubicaciones\CentroDormitorio;

class UbicacionReubicacion extends Model
{
  use HasFactory;

  /**
   * Summary of table
   * @var string
   */
  protected $table = 'ubicacion_reubicacion';

  /**
   * Summary of primaryKey
   * @var string
   */
  protected $fillable = [
    'persona_id',
    'centro_id',
    'dormitorio_id',
    'modulo_id',
    'seccion_id',
    'estancia_id',
    'cama_id',
    'id_ubi_temp',
    'motivo_reubicacion',
    'fecha_reubicacion',
    'tiempo_estancia',
    'fecha_registro',
    'actual',
    'usuario_registro',
  ];

  /**
   * Summary of casts
   * @var array
   */
  protected $casts = [
    'motivo_reubicacion' => 'string',
    'tiempo_estancia' => 'integer',
    'usuario_registro' => 'array',
    'dormitorio_id' => 'integer',
    'modulo_id' => 'integer',
    'seccion_id' => 'integer',
    'cama_id' => 'integer',
    'centro_id' => 'integer',
    'persona_id' => 'integer',
    'estancia_id' => 'integer',
    'fecha_reubicacion' => 'date',
    'fecha_registro' => 'date',
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
  public function scopeDisponible($query)
  {
    return $query->where('estatus', 1)->whereColumn('capacidad', '>', 'ocupados');
  }
  /*------------------------------------------------------------------------*/

  /*-------------------------------- RELACIONES ------------------------------*/
  /**
   * Summary of persona
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function persona(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
    return $this->belongsTo(Persona::class, 'persona_id');
  }

  /**
   * Summary of centro
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function centro(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
    return $this->belongsTo(Centro::class, 'centro_id');
  }

  /**
   * Summary of dormitorio
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function dormitorio(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
    return $this->belongsTo(CentroDormitorio::class, 'dormitorio_id');
  }

  /**
   * Summary of modulo
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function modulo(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
    return $this->belongsTo(CentroModulo::class, 'modulo_id');
  }

  /**
   * Summary of seccion
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function seccion(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
    return $this->belongsTo(CentroSeccion::class, 'seccion_id');
  }

  /**
   * Summary of estancia
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function estancia(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
    return $this->belongsTo(CentroEstancia::class, 'estancia_id');
  }

  /**
   * Summary of cama
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function cama(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
    return $this->belongsTo(CentroCama::class, 'cama_id');
  }
  /*------------------------------------------------------------------------*/
}
