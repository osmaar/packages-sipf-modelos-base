<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Evasion extends FFV
{
  use HasFactory;
  use SoftDeletes;

  protected $table = 'evasiones';
  protected $appends = ['denuncia'];

  protected $fillable = [
    "id",
    "expediente_id",
    "carpeta_investigacion",
    "fecha_evasion",
    "oficio",
    "ruta_denuncia",
    "descripcion"
  ];

  public $rules = [
    'carpeta_investigacion' => 'string|max:50|required',
    'fecha_evasion' => 'date_format:Y-m-d H:i:s|required',
    'oficio' => 'string|max:50|required',
    'descripcion' => 'string|max:600|required',
  ];

  /**
   *Relaciones Eloquent
   */

  public function expediente()
  {
    return $this->belongsTo(Expediente::class);
  }

  /**
   *Scopes
   */

  public function scopeActiva($query)
  {
    return $query->whereNotIn('evasiones.estatus', ['cerrado']);
  }
  public function scopeUltima($query)
  {
    return $query->latest('updated_at')->take(1);
  }

  /**
   *Atributos
   */

  public function getDenunciaAttribute()
  {
    if ($this->ruta_denuncia) {
      $dir = 'storage/egresos/' . implode('/', str_split($this->id, 2)) . '/assets/';
      return asset($dir . $this->ruta_denuncia . '?' . time());
    }
    return null;
  }

  public function getEstaFinalizadoAttribute()
  {
    if (in_array($this->estatus, ['cerrado'])) {
      return true;
    }
    return false;
  }

  /**
   *Otros Métodos
   */
}
