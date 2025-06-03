<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RutasAccesosModel extends Model
{
  use HasFactory;

  protected $table = 'rutas_accesos';

  protected $casts   = [
    'activa' => 'boolean'
  ];
  protected $guarded = [];
}
