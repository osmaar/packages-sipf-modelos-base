<?php

namespace App\Models\Juridico;

use Illuminate\Database\Eloquent\Model;
use Sipf\ModelosBase\Models\LibertadAmparo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LibertadAmparoResolucion extends Model
{
  use HasFactory;
  use SoftDeletes;

  protected $table = "libertad_amparos_resoluciones";

  protected $fillable = [
    'id',
    'libertad_amparo_id',
    'fecha_resolucion',
    'sentido_resolucion_id',
    'oficio_resolucion_nombre',
    'oficio_resolucion_ruta',

  ];

  public function libertadAmparo()
  {
    return $this->belongsTo(LibertadAmparo::class, 'libertad_amparo_id');
  }
}
