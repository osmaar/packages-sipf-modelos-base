<?php

namespace Sipf\ModelosBase\Models\Tecnico\Seguridad\PaseDeLista;

use Sipf\ModelosBase\Models\Centro;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Sipf\ModelosBase\Models\Ubicaciones\CentroModulo;
use Sipf\ModelosBase\Models\Ubicaciones\CentroSeccion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Sipf\ModelosBase\Models\Ubicaciones\CentroEstancia;
use Sipf\ModelosBase\Models\Ubicaciones\CentroDormitorio;

class ReglaDeAsignacion extends Model
{
  use HasFactory, SoftDeletes;

  protected $table = 'reglas_de_asignacion';

  protected $fillable = [
    'id',
    'centro_id',
    'dormitorio_id',
    'modulo_id',
    'estancia_id',
    'lugar',
    'estatus',
  ];

  /**
   * Casteo de datos
   *
   * @var array
   */
  protected $casts = [
    'estatus' => 'string',
  ];

  /*-------------------------------- SCOPES ------------------------------*/
  /**
   * Filter the Centro
   * @param mixed $query
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopeDeCentro($query, $centro_id)
  {
    return $query->where('centro_id', $centro_id);
  }

  /**
   * Filtrar por regla de asignación.
   */
  public function scopeDeReglaAsignacion($query, $regla_asignacion_id)
  {
    return $query->where('id', $regla_asignacion_id);
  }

  /**
   * Filtrar por turno.
   */
  public function scopeDeTurno($query, $turno)
  {
    return $query->whereHas('turnos', function ($query) use ($turno) {
      $query->where('turno', $turno);
    });
  }

  /**
   * Filtrar por lugar.
   */
  public function scopeDeLugar($query, $lugar)
  {
    return $query->where('lugar', $lugar);
  }

  /**
   * Filtrar por dormitorio.
   */
  public function scopeDeDormitorio($query, $dormitorio)
  {
    return $query->whereHas('dormitorio', function ($query) use ($dormitorio) {
      $query->where('nombre', $dormitorio)->orWhereNull('nombre');
    });
  }

  /**
   * Filtrar por módulo.
   */
  public function scopeDeModulo($query, $modulo)
  {
    return $query->whereHas('modulo', function ($query) use ($modulo) {
      $query->where('nombre', $modulo)->orWhereNull('nombre');
    });
  }

  /**
   * Filtrar por cama.
   */
  public function scopeDeSeccion($query, $seccion)
  {
    return $query->whereHas('estancia', function ($query) use ($seccion) {
      $query->where('nombre', $seccion)->orWhereNull('nombre');
    });
  }
  /*------------------------------------------------------------------------*/

  /*-------------------------------- RELACIONES ------------------------------*/
  /**
   * Return the relationship to the centro
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function centro(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
    return $this->belongsTo(Centro::class, 'centro_id');
  }

  /**
   * Return the relationship to the dormitorio
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function dormitorio(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
    return $this->belongsTo(CentroDormitorio::class, 'dormitorio_id');
  }

  /**
   * Return the relationship to the modulo
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function modulo(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
    return $this->belongsTo(CentroModulo::class, 'modulo_id');
  }

  /**
   * Return the relationship to the estancia
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function estancia(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
    return $this->belongsTo(CentroEstancia::class, 'lugar', 'centros_lugar');
  }

  /**
   * Return the relationship to the estancia
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function seccion(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
    return $this->belongsTo(CentroSeccion::class, 'seccion_id');
  }

  /**
   * Return the relationship to the estancia
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function secciones(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
  {
    return $this->belongsToMany(CentroSeccion::class, 'regla_de_asignacion_seccion', 'regla_de_asignacion_id', 'seccion_id',);
  }

  /**
   * Return the relationship to the turnos
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function turnos(): \Illuminate\Database\Eloquent\Relations\HasMany
  {
    return $this->hasMany(Turno::class, 'regla_asignacion_id');
  }
  /*------------------------------------------------------------------------*/
}
