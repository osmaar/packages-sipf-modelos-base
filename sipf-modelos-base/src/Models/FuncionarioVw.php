<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FuncionarioVw extends Model
{
  use HasFactory;

  protected $table = "funcionarios_vw";

  protected $fillable = [
    'id',
    'sich_id',
    'numero_empleado',
    'nombre',
    'primer_apellido',
    'segundo_apellido',
    'cargo_id',
    'cargo',
    'unidad_administrativa_id',
    'unidad_administrativa',
    'activo',
    'activado_sipf'
  ];

  /**
   * Obtiene el nombre completo del funcionario
   *
   * @return void
   */
  public function getNombreCompletoAttribute()
  {
    return implode(' ', array_filter([
      $this->titulo,
      $this->nombre,
      $this->primer_apellido,
      $this->segundo_apellido
    ]));
  }

  /**
   * Obtiene el origen del funcionario
   *
   * @return void
   */
  public function getOrigenAttribute()
  {
    return $this->sich_id ? 'SICH' : 'Manual';
  }
}
