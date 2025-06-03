<?php

namespace Sipf\ModelosBase\Models\Catalogos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CtgTipoInvolucrado extends Model
{

  use HasFactory, SoftDeletes;

  protected $table = 'ctg_tipos_involucrado';

  protected $fillable = [
    'id',
    'descripcion',
  ];
}
