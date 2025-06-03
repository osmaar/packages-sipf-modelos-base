<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitaFamiliarCredencial extends Model
{
  use HasFactory;

  protected $table = 'visita_familiares_credenciales';

  protected $casts   = [
    'activa' => 'boolean'
  ];
  protected $guarded = [];

  public function propuesta()
  {
    return $this->belongsTo(VisitaFamiliar::class, 'visita_familiar_id');
  }
}
