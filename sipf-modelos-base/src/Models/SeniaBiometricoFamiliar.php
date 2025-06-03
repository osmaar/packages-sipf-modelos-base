<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * guarda la foto del familiar para su identificación
 */
class SeniaBiometricoFamiliar extends FFV
{
  use HasFactory;

  protected $table    = 'senias_biometricos_familiar';
  protected $fillable = [
    'id',
    'familiar_id',
    'ruta_foto'
  ];
  protected $dates    = ['deleted_at'];

  use SoftDeletes;

  /**
   * obtiene la ruta de la imagen
   *
   * @param [type] $value
   * @return void
   */
  public function getRutaFotoAttribute($value)
  {

    $img = asset($this->_dir() . $value . '?' . time());
    if (file_exists($img)) {
      return $img;
    }
    return 'assets/images/users/avatar-1.jpg';
  }

  /**
   * crea la ruta en donde se guardara la imagen
   *
   * @return void
   */
  private function _dir()
  {
    return 'storage/personaFamiliar/' . implode('/', str_split($this->familiar_id, 2)) . '/assets/biometrico/';
  }

  public function persona_familiar()
  {
    return $this->belongsTo(Referencia::class);
  }
}
