<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Sipf\ModelosBase\Models\Tecnico\Seguridad\Sanciones\Sancion;

class ApelacionesSancion extends Model
{
  use HasFactory;
  protected $table = 'apelaciones_sanciones';

  protected $fillable = [
    'sancion_id',
    'observaciones',
    'file_name',
    'file_path',
    'en_comite',
    'fecha_solicitud',
    'fecha_resolucion',
    'no_sesion_comite',
    'organo_jurisdiccional',
    'fecha_suspencion',
    'tipo_sancion',
    'fecha_inicio_sancion',
    'fecha_fin_sancion',
    'fecha_fin_real_sancion',
    'observaciones_resolucion',
    'file_name_resoluccion',
    'file_path_resoluccion',
    'incidente_id',
    'fecha_envio_seguridad',
  ];


  protected $casts = [
    'fecha_solicitud' => 'datetime',
    'fecha_resolucion' => 'datetime',
    'fecha_suspencion' => 'datetime',
    'fecha_inicio_sancion' => 'datetime',
    'fecha_fin_sancion' => 'datetime',
    'fecha_fin_real_sancion' => 'datetime',
    'observaciones_resolucion' => 'string',
  ];

  public function sancion()
  {
    return $this->belongsTo(Sancion::class);
  }

  public function incidente()
  {
    return $this->belongsTo(Incidente::class);
  }
}
