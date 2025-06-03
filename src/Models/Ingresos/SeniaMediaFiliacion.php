<?php

namespace App\Models\Ingresos;

use Sipf\ModelosBase\Models\Persona;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Sipf\ModelosBase\Models\CatalogosFlexFields\Complexion;

class SeniaMediaFiliacion extends Model
{
  use HasFactory;
  use SoftDeletes;

  protected $table = 'senias_media_filiacion';

  protected $fillable = [
    'id',
    'persona_id',
    'complexion',
    'color_piel',
    'cara',
    'cabello_cantidad',
    'cabello_color',
    'cabello_forma',
    'calvicie',
    'implantacion',
    'altura_frente',
    'inclinacion_frente',

    'ancho_frente',
    'direccion_cejas',
    'implantacion_cejas',
    'forma_cejas',
    'tamanio_cejas',
    'color_ojos',
    'forma_ojos',
    'tamanio_ojos',
    'nariz_raiz',
    'nariz_dorso',

    'nariz_ancho',
    'nariz_base',
    'nariz_altura',
    'boca_tamanio',
    'boca_comisuras',
    'boca_espesor',
    'boca',
    'boca_prominencia',
    'menton_tipo',
    'menton_forma',

    'menton_inclinacion',
    'oreja_d_forma',
    'oreja_d_trago',
    'oreja_d_antitrago',
    'oreja_d_helix_adherencia',
    'oreja_d_helix_original',
    'oreja_d_helix_posterior',
    'oreja_d_helix_superior',
    'oreja_d_lobulo_contorno',
    'oreja_d_lobulo_adherencia',

    'oreja_d_lobulo_dimension',
    'oreja_d_lobulo_particularidad',
    'tipo_sangre',
    'factor_rh',
  ];

  public function complexionObj()
  {
    return $this->hasOne(Complexion::class, "complexion");
  }

  public function persona()
  {
    return $this->belongsTo(Persona::class);
  }
}
