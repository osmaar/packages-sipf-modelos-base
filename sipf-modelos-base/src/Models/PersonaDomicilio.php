<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonaDomicilio extends Model
{
  use HasFactory;
  use SoftDeletes;

  protected $table = 'persona_domicilios';

  protected $fillable = [
    'persona_id',
    'domicilio_exacto',
    'pais',
    'estado',
    'c_estado',
    'municipio',
    'c_mnpio',
    'calle',
    'numero_ext',
    'numero_int',
    'colonia',
    'otra_colonia',
    'id_asenta_cpcons',
    'cp',
    'entre_calle',
    'y_calle',
    'lada',
    'telefono',
    'observaciones'
  ];

  public function persona()
  {
    return $this->belongsTo(Persona::class, 'persona_id', 'id');
  }

  public function asenta()
  {
    return $this->belongsTo(Sepomex::class, "id_asenta_cpcons", "id_asenta_cpcons")
      ->where("c_estado", "=", $this->c_estado)
      ->where("c_mnpio", "=", $this->c_mnpio)
    ;
  }
}
