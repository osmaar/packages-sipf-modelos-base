<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Sipf\ModelosBase\Models\CatalogosFlexFields\Complexion;

class SeniaMediaFiliacion extends FFV
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
        'observaciones',
    ];

    public $rules = [
        'altura_frente' => 'integer|required',
        'ancho_frente' => 'integer|required',
        'boca_espesor' => 'integer|required',
        'boca_tamanio' => 'integer|required',
        'cabello_cantidad' => 'integer|required',
        'cabello_color' => 'integer|required',
        'cabello_forma' => 'integer|required',

        'calvicie' => 'integer|required',
        'cara' => 'integer|required',
        'color_ojos' => 'integer|required',
        'color_piel' => 'integer|required',
        'complexion' => 'integer|required',
        'forma_cejas' => 'integer|required',
        'forma_ojos' => 'integer|required',
        'implantacion' => 'integer|required',

        'implantacion_cejas' => 'integer|required',
        'inclinacion_frente' => 'integer|required',
        'menton_forma' => 'integer|required',
        'menton_inclinacion' => 'integer|required',
        'menton_tipo' => 'integer|required',
        'nariz_ancho' => 'integer|required',
        'nariz_base' => 'integer|required',
        'nariz_dorso' => 'integer|required',
        'nariz_raiz' => 'integer|required',

        'oreja_d_antitrago' => 'integer|required',
        'oreja_d_forma' => 'integer|required',
        'oreja_d_lobulo_adherencia' => 'integer|required',
        'oreja_d_lobulo_contorno' => 'integer|required',
        'oreja_d_lobulo_dimension' => 'integer|required',
        'oreja_d_lobulo_particularidad' => 'integer|required',

        'oreja_d_trago' => 'integer|required',
        'tamanio_cejas' => 'integer|required',
        'tamanio_ojos' => 'integer|required',

    ];

    public function complexion()
    {
        return $this->flex();
    }
    public function color_piel()
    {
        return $this->flex();
    }
    public function cara()
    {
        return $this->flex();
    }
    public function cabello_cantidad()
    {
        return $this->flex();
    }
    public function cabello_color()
    {
        return $this->flex();
    }
    public function cabello_forma()
    {
        return $this->flex();
    }
    public function calvicie()
    {
        return $this->flex();
    }
    public function implantacion()
    {
        return $this->flex();
    }
    public function altura_frente()
    {
        return $this->flex();
    }
    public function inclinacion_frente()
    {
        return $this->flex();
    }
    public function ancho_frente()
    {
        return $this->flex();
    }
    public function direccion_cejas()
    {
        return $this->flex();
    }
    public function implantacion_cejas()
    {
        return $this->flex();
    }
    public function forma_cejas()
    {
        return $this->flex();
    }
    public function tamanio_cejas()
    {
        return $this->flex();
    }
    public function color_ojos()
    {
        return $this->flex();
    }
    public function forma_ojos()
    {
        return $this->flex();
    }
    public function tamanio_ojos()
    {
        return $this->flex();
    }
    public function nariz_raiz()
    {
        return $this->flex();
    }
    public function nariz_dorso()
    {
        return $this->flex();
    }
    public function nariz_ancho()
    {
        return $this->flex();
    }
    public function nariz_base()
    {
        return $this->flex();
    }
    public function nariz_altura()
    {
        return $this->flex();
    }
    public function boca_tamanio()
    {
        return $this->flex();
    }
    public function boca_comisuras()
    {
        return $this->flex();
    }
    public function boca_espesor()
    {
        return $this->flex();
    }
    public function boca()
    {
        return $this->flex();
    }
    public function boca_prominencia()
    {
        return $this->flex();
    }
    public function menton_tipo()
    {
        return $this->flex();
    }
    public function menton_forma()
    {
        return $this->flex();
    }
    public function menton_inclinacion()
    {
        return $this->flex();
    }
    public function oreja_d_forma()
    {
        return $this->flex();
    }
    public function oreja_d_trago()
    {
        return $this->flex();
    }
    public function oreja_d_antitrago()
    {
        return $this->flex();
    }
    public function oreja_d_helix_adherencia()
    {
        return $this->flex();
    }
    public function oreja_d_helix_original()
    {
        return $this->flex();
    }
    public function oreja_d_helix_posterior()
    {
        return $this->flex();
    }
    public function oreja_d_helix_superior()
    {
        return $this->flex();
    }
    public function oreja_d_lobulo_contorno()
    {
        return $this->flex();
    }
    public function oreja_d_lobulo_adherencia()
    {
        return $this->flex();
    }
    public function oreja_d_lobulo_dimension()
    {
        return $this->flex();
    }
    public function oreja_d_lobulo_particularidad()
    {
        return $this->flex();
    }
    public function tipo_sangre()
    {
        return $this->flex();
    }
    public function factor_rh()
    {
        return $this->flex();
    }

    public function observaciones()
    {
        return $this->flex();
    }

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }

    public function complexionObj()
    {
        return $this->hasOne(Complexion::class, "id", "complexion");
    }
}
