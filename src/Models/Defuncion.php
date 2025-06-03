<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Defuncion extends FFV
{
  use HasFactory;
  use SoftDeletes;

  protected $table = 'defunciones';

  protected $fillable = [
    "expediente_id",
    "acta_certificado",
    "acta_certificado_desc",
    "ruta_acta_certificado",
    "medico_emite",
    "motivo_defuncion",
    "lugar_defuncion",
    "descripcion",
    "fecha_defuncion",
    "oficio",
    "ruta_oficio"
  ];

  public function expediente()
  {
    return $this->belongsTo(Expediente::class);
  }

  public function actaCertificado()
  {
    return $this->flex();
  }

  public function motivoDefuncion()
  {
    return $this->flex();
  }

  public function lugarDefuncion()
  {
    return $this->flex();
  }

  public function acta_certificado()
  {
    return $this->flex();
  }

  public function motivo_defuncion()
  {
    return $this->flex();
  }

  public function lugar_defuncion()
  {
    return $this->flex();
  }

  public function getEstaFinalizadoAttribute()
  {
    return true;
  }
}
