<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Centro extends Model
{
  use HasFactory;
  use SoftDeletes;

  /**
   * Summary of table
   * @var string
   */
  protected $table = 'centros';

  /**
   * Summary of fillable
   * @var array
   */
  protected $fillable = [
    'entidad_federativa',
    'municipio',
    'nombre_completo',
    'nombre_centro',
    'entrada',
    'numero',
    'codigo',
    'tipo',
  ];


  /*-------------------------------- RELACIONES ------------------------------*/
  /**
   * Función para obtener los expedientes de un centro
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function expedientes()
  {
    return $this->hasMany(Expediente::class);
  }

  /**
   * Función para obtener los Usuarios de un centro
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function user()
  {
    return $this->belongsTo(User::class);
  }
  /*------------------------------------------------------------------------*/

  public function terminales(): HasMany
  {
    return $this->hasMany(Terminal::class, 'centro_id');
  }

  public function municipioSepomex()
  {
    return $this->hasOne(SepomexMunicipios::class, 'c_mnpio', 'municipio')
      ->where('c_estado', $this->entidad_federativa);
  }
}
