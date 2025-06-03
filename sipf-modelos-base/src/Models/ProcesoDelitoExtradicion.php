<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProcesoDelitoExtradicion extends FFV
{
  use HasFactory;
  use SoftDeletes;

  protected $table = 'proceso_delitos_extradicion';

  protected $fillable = [
    'id',
    'proceso_id',
    'delito'
  ];
  public function proceso()
  {
    return $this->belongsTo(Proceso::class, 'proceso_id');
  }
}
