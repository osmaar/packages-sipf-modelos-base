<?php

namespace Sipf\ModelosBase\Models\Tecnico\Criminologia;

use Sipf\ModelosBase\Models\Persona;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AnalisisRiesgo extends Model
{
  use HasFactory;

  /**
   * Summary of table
   * @var string
   */
  protected $table = 'analisis_riesgo';

  /**
   * Summary of primaryKey
   * @var string
   */
  protected $fillable = [
    'persona_id',
    'clasificacion_criminologica',
    'indice_criminologico_adaptabilidad_social',
    'indice_criminologico_nivel_de_peligrosidad',
    'indice_criminologico_del_estado_peligroso',
    'indice_criminologico_riesgo_institucional',
    'indice_criminologico_capacidad_criminal',
    'indice_peligrosidad_actual',
    'posibilidad_reincidencia',
    'medida_vigilancia_especial',
    'medida_vigilancia_especial_otro',
    'medida_de_vigilancia',
    'fecha_analisis',
    'usuario_registro'
  ];

  /**
   * Summary of casts
   * @var array
   */
  protected $casts = [
    'persona_id' => 'integer',
    'usuario_registro' => 'array',
    'fecha_analisis' => 'datetime',
    'medida_de_vigilancia' => 'array',
  ];

  /*-------------------------------- RELACIONES ------------------------------*/
  /**
   * Summary of persona
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function persona(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
    return $this->belongsTo(Persona::class, 'persona_id');
  }
  /*------------------------------------------------------------------------*/

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
  /*------------------------------------------------------------------------*/
}
