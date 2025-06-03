<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Sipf\ModelosBase\Models\CatalogosFlexFields\Delito;
use Sipf\ModelosBase\Models\CatalogosFlexFields\TipoComision;

class ProcesoDelito extends FFV
{
  use HasFactory;
  use SoftDeletes;

  protected $table = 'proceso_delitos';

  protected $fillable = [
    'id',
    'proceso_id',
    'delito',
    'modalidad_delito',
    'fecha_comision',
    'fuero',
    'estado',
    'delito_principal',
    'tipo_comision',
    'como_dicta_juez'
  ];

  protected $dates = ['deleted_at'];

  public static $rules = [
    'id' => 'integer',
    'proceso_id' => 'integer',
    'delito' => 'integer',
    'modalidad_delito' => 'integer',
    'fuero' => 'integer',
    'delito_principal' => 'in:Si,No',
  ];

  public function delito()
  {
    return $this->flex();
  }

  public function fuero()
  {
    return $this->flex();
  }

  public function modalidadDelito()
  {
    return $this->flex();
  }

  public function procesoDelito()
  {
    return $this->hasMany(ProcesoDelito::class);
  }

  public function proceso()
  {
    return $this->belongsTo(Proceso::class, 'proceso_id');
  }

  public function tipoComision()
  {
    return $this->belongsTo(TipoComision::class, 'tipo_comision');
  }

  public function modalidad_delito()
  {
    return $this->flex();
  }

  public function scopeDoloso($query)
  {
    return $query->where("tipo_comision", "=", 1173);
  }

  public function scopeDelincuenciaOrganizada($query)
  {
    return $query->where("delito", "=", Delito::DELINCUENCIA_ORGANIZADA);
  }
}
