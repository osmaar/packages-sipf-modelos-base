<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatalogoSancionesAplicables extends Model
{
  use HasFactory;

  protected $fillable = [
    'descripcion',
    'regla',
    'ley_aplicable_id',
  ];

  public function ley()
  {
    return $this->belongsTo(LeyAplicable::class, 'ley_aplicable_id');
  }
}
