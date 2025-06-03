<?php

namespace Sipf\ModelosBase\Models\Tecnico\TrabajoSocial\Pases;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Sipf\ModelosBase\Models\CatalogosFlexFields\Parentesco;

class Pase extends Model
{
  use SoftDeletes;
  use HasFactory;

  protected $table = 'pases';

  protected $fillable = [
    'id',
    'persona_id',
    'parentesco_id',
    'pass',
    'start',
    'end',
    'print',
    'status',
    'active',
    'nombre',
  ];

  public $searchable = [
    'parentesco.description',
    'pass',
    'nombre'
  ];

  /**
   *Relaciones Eloquent
   */
  public function parentesco()
  {
    return $this->belongsTo(Parentesco::class, "parentesco_id", "value");
  }

  /**
   *Scopes
   */

  public function scopeEsParaFamiliar($query)
  {
    return $query->where("parentesco_id", "<>", 1187);
  }

  /**
   *Atributos
   */
  public  function getStartFormatAttribute()
  {
    return substr($this->start, 0, 5);
  }

  public  function getEndFormatAttribute()
  {
    return substr($this->end, 0, 5);
  }
}
