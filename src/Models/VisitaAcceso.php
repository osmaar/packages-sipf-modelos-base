<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitaAcceso extends Model
{
  use HasFactory;

  protected $table = 'visitas_accesos';

  protected $casts   = [
    'activa'           => 'boolean',
    'ppl_ids'          => 'array',
    'visita_todos'     => 'boolean',
    'visita_realizada' => 'boolean'
  ];
  protected $guarded = [];
}
