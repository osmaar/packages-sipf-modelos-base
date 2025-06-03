<?php

namespace App\Models\Models\Tecnico\Seguridad\Sanciones;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Sipf\ModelosBase\Models\Tecnico\Seguridad\Sanciones\Sancion;

class AmparosSancion extends Model
{
  use HasFactory;

  protected $table = 'amparos_sanciones';

  protected $fillable = [
    'sancion_id',
    'observaciones',
    'file_name',
    'file_path',
    'enviado_comite',
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


  public function sancion()
  {
    return $this->belongsTo(Sancion::class);
  }
}
