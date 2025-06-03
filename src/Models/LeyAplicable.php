<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeyAplicable extends Model
{
  use HasFactory;

  protected $table = 'leyes_aplicables';

  protected $fillable = [
    'ley_aplicable',
    'nomenclatura',
  ];

  public function articulos()
  {
    return $this->hasMany(ArticuloLey::class, 'ley_aplicable_id');
  }
}
