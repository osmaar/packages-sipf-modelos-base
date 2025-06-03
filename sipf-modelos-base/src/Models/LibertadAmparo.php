<?php

namespace Sipf\ModelosBase\Models;

use App\Models\Juridico\LibertadAmparoResolucion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Sipf\ModelosBase\Models\CatalogosFlexFields\AutoridadJudicial;
use Sipf\ModelosBase\Models\CatalogosFlexFields\Circuito;
use Sipf\ModelosBase\Models\CatalogosFlexFields\SentidoResolucionAmparo;

class LibertadAmparo extends Model
{
  use HasFactory;
  use SoftDeletes;

  protected $table = "libertad_amparos";

  protected $fillable = [
    'id',
    'libertad_id',
    'circuito_id',
    'autoridad_judicial_id',
    'numero_amparo',
    'fecha',
    'oficio_nombre',
    'oficio_ruta',

    'fecha_resolucion',
    'sentido_resolucion_id',
    'oficio_resolucion_nombre',
    'oficio_resolucion_ruta',

    'resolucion_modificable',

    'usuario_registro'
  ];

  public function libertad()
  {
    return $this->belongsTo(Libertad::class, 'libertad_id');
  }

  public function circuito()
  {
    return $this->belongsTo(Circuito::class, 'circuito_id');
  }

  public function autoridadJudicial()
  {
    return $this->belongsTo(AutoridadJudicial::class, 'autoridad_judicial_id');
  }

  public function sentidoResolucion()
  {
    return $this->belongsTo(SentidoResolucionAmparo::class, 'sentido_resolucion_id');
  }

  public function resoluciones()
  {
    return $this->hasMany(LibertadAmparoResolucion::class, "libertad_amparo_id");
  }
}
