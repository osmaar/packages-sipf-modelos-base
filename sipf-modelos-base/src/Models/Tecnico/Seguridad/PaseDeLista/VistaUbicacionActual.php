<?php

namespace Sipf\ModelosBase\Models\Tecnico\Seguridad\PaseDeLista;

use App\Services\LugarMap;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Sipf\ModelosBase\Models\Centro;
use Sipf\ModelosBase\Models\Persona;
use Sipf\ModelosBase\Models\Tecnico\Criminologia\UbicacionReubicacion;
use Sipf\ModelosBase\Models\Ubicaciones\CentroCama;
use Sipf\ModelosBase\Models\Ubicaciones\CentroDormitorio;
use Sipf\ModelosBase\Models\Ubicaciones\CentroEstancia;
use Sipf\ModelosBase\Models\Ubicaciones\CentroModulo;
use Sipf\ModelosBase\Models\Ubicaciones\CentroSeccion;

class VistaUbicacionActual extends Model
{
  // Desactiva los timestamps
  public $timestamps = false;

  // Nombre de la vista en la base de datos

  protected $table = 'vista_ubicacion_actuales';

  // Especifica los campos disponibles en la vista
  protected $fillable = [
    'id',
    'regla_de_asignacion_id',
    'turno_id',
    'turno',
    'user_id',
    'persona_id',
    'nombre',
    'primer_apellido',
    'segundo_apellido',
    'lugar_id',
    'centro_id',
    'dormitorio_id',
    'modulo_id',
    'seccion_id',
    'estancia_id',
    'cama_id',
    'id_ubi_temp'
  ];

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

  public function ubicacion(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
    return $this->belongsTo(UbicacionReubicacion::class, 'id_ubi_temp');
  }

  public function scopeDeCentro($query, $centro_id): Builder
  {
    return $query->where('centro_id', $centro_id);
  }

  public function scopeDeTurno($query, $turno): Builder
  {
    return $query->where('turno', $turno);
  }

  public function scopeDeReglaAsignacion($query, $regla_id): Builder
  {
    return $query->where('regla_de_asignacion_id', $regla_id);
  }

  public function scopeDeCustodio($query, $custodio_id): Builder
  {
    return $query->where('custodio_id', $custodio_id);
  }

  /**
   * Accesor para el campo lugar.
   *
   * @return string|null
   */
  public function getLugarNombreAttribute()
  {
    return LugarMap::getDescripcion($this->lugar_id);
  }
}
