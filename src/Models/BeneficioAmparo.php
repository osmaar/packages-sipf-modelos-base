<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BeneficioAmparo extends Model
{
  use HasFactory;
  use SoftDeletes;

  protected $table = "beneficios_amparos";

  protected $fillable = [
    'id',
    'beneficio_id',
    'circuito',
    'juzgado',
    'numero_amparo',
    'fecha_amparo',
    'fecha_resolucion_amparo',
    'sentido_resolucion_amparo',
    'ruta_amparo_resolucion',
    'ruta_amparo',
    'readonly'
  ];

  public function juzgado()
  {
    return $this->flex();
  }

  public function sentido_resolucion_amparo()
  {
    return $this->flex();
  }

  public function beneficio()
  {
    return $this->belongsTo(Beneficio::class, 'beneficio_id');
  }
}
