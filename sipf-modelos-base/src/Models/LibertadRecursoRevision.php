<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Sipf\ModelosBase\Models\Catalogos\CtgSentidoResolucionRecursoRevision;
use Sipf\ModelosBase\Models\CatalogosFlexFields\AutoridadJudicial;
use Sipf\ModelosBase\Models\CatalogosFlexFields\Circuito;

class LibertadRecursoRevision extends Model
{
  use HasFactory;
  use SoftDeletes;

  protected $table = 'libertad_recursos_revision';

  protected $fillable = [
    'id',
    'libertad_id',
    'circuito_id',
    'autoridad_judicial_id',
    'numero_recurso',
    'fecha',
    'oficio_nombre',
    'oficio_ruta',

    'fecha_resolucion',
    'sentido_resolucion_id',
    'oficio_resolucion_nombre',
    'oficio_resolucion_ruta',

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
    return $this->belongsTo(CtgSentidoResolucionRecursoRevision::class, 'sentido_resolucion_id');
  }
}
