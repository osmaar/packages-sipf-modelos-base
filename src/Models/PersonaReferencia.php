<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Sipf\ModelosBase\Models\CatalogosFlexFields\Parentesco;

/**
 * Clase Familiar para obtener los datos de los familiares de la persona que es el ppl.
 */
class PersonaReferencia extends FFV
{
  use HasFactory;

  public    $incrementing = false;
  protected $primaryKey   = null;
  protected $guarded      = [];

  protected $table = 'personas_referencias';

  /**
   * Obtiene el catalogo de parentesco a partir del campo que esta dentro de la tabla familiares parentesco ocupación del flexfield..
   *
   * @return void
   */
  public function parentesco()
  {
    return $this->flex();
  }

  public function persona()
  {
    return $this->belongsTo('personas');
  }

  public function familiar()
  {
    return $this->belongsTo('familiares', 'familiar_id');
  }

  public function referencia_id()
  {
    return $this->hasOne(Referencia::class, "id", "referencia_id");
  }

  public function parentescoObj()
  {
    return $this->belongsTo(Parentesco::class, "parentesco");
  }
}
