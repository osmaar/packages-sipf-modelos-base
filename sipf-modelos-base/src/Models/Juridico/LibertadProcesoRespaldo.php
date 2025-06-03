<?php

namespace App\Models\Juridico;

use Sipf\ModelosBase\Models\Libertad;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LibertadProcesoRespaldo extends Model
{
  use HasFactory;
  use SoftDeletes;

  protected $table = "libertad_proceso_respaldos";

  protected $fillable = [
    'id',
    'libertad_id',
    'fecha_vinculacion',
    'fecha_sentencia',
    'proceso_estatus',
    'estatus',
    'proceso_clasificacion',
    'estatus_libertad',
  ];

  public function libertad()
  {
    return $this->belongsTo(Libertad::class, 'libertad_id');
  }
}
