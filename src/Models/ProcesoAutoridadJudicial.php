<?php

namespace Sipf\ModelosBase\Models;

use Sipf\ModelosBase\Models\CatalogosFlexFields\AutoridadJudicial;

class ProcesoAutoridadJudicial extends  FFV
{

  protected $table = 'proceso_autoridad_judicial';

  protected $fillable = [
    'proceso_id',
    'circuito_id',
    'autoridad_id',
  ];

  public function proceso()
  {
    return $this->belongsTo(Proceso::class, 'proceso_id');
  }

  public function autoridadJudicial()
  {
    return $this->belongsTo(AutoridadJudicial::class, "autoridad_id", "id");
  }

  public function autoridadId()
  {
    return $this->flex();
  }

  public function autoridad_id()
  {
    return $this->flex();
  }
}
