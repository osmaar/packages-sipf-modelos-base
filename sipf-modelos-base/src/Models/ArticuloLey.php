<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticuloLey extends Model
{
  use HasFactory;

  protected $table = 'articulo_leyes';

  protected $fillable = [
    'descripcion',
    'ley_aplicable_id',
    'regla',
  ];

  public function ley()
  {
    return $this->belongsTo(LeyAplicable::class, 'ley_aplicable_id');
  }
}
