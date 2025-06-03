<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Sipf\ModelosBase\Models\CatalogosFlexFields\Talla;

class SeniaAntropometrico extends FFV
{
  use HasFactory;
  use SoftDeletes;

  protected $table = 'senias_antropometricos';
  protected $fillable = [
    'id',
    'persona_id',
    'estatura',
    'peso',
    'talla',
    'talla_playera',
    'longitud_pie',
    'formula',
    'subformula',
    'formula_izquierda',
    'subformula_izquierda',
    'formula_vucetich',
    'anteojos'
  ];

  public function talla()
  {
    return $this->flex();
  }

  public function talla_playera()
  {
    return $this->flex();
  }

  public function expediente()
  {
    return $this->belongsTo(Expediente::class);
  }

  public function tallaObj()
  {
    return $this->belongsTo(Talla::class, "talla");
  }
}
