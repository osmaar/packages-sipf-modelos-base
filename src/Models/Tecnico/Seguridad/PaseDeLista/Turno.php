<?php

namespace Sipf\ModelosBase\Models\Tecnico\Seguridad\PaseDeLista;

use Sipf\ModelosBase\Models\User;
use Sipf\ModelosBase\Models\Centro;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Turno extends Model
{
  use HasFactory, SoftDeletes;

  /**
   * Tabla para turnos
   * @var string
   */
  protected $table = 'turnos';


  /**
   * Datos de la tabla
   *
   * @var array
   */
  protected $fillable = [
    'id',
    'centro_id',
    'regla_asignacion_id',
    'turno',
  ];
  /*-------------------------------- SCOPES ------------------------------*/
  /**
   * Filter the ubications
   * @param mixed $query
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopeDeCentro($query, $centro_id)
  {
    $query->where('centro_id', $centro_id);
    return $query;
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
   * Return the relationship to the regla de asignacion
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function reglaAsignacion()
  {
    return $this->belongsTo(ReglaDeAsignacion::class, 'regla_asignacion_id');
  }

  /**
   * Return the relationship to the usuarios
   * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
   */
  public function usuarios(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
  {
    return $this->belongsToMany(User::class, 'turnos_usuarios', 'turno_id', 'user_id');
  }
  /*------------------------------------------------------------------------*/
}
