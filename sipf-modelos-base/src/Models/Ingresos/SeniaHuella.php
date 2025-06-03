<?php

namespace App\Models\Ingresos;

use Sipf\ModelosBase\Models\Persona;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SeniaHuella extends Model
{
  use HasFactory;
  use SoftDeletes;

  protected $table = 'senias_huellas';
  protected $fillable = [
    'extremidad_izquierdo',
    'extremidad_derecho',
    'situacion_dedo_a',
    'situacion_dedo_b',
    'situacion_dedo_c',
    'situacion_dedo_d',
    'situacion_dedo_e',
    'situacion_dedo_f',
    'situacion_dedo_g',
    'situacion_dedo_h',
    'situacion_dedo_i',
    'situacion_dedo_j',
    'situacion_palmar_derecho',
    'situacion_palmar_izquierdo',
    'situacion_canto_derecho',
    'situacion_canto_izquierdo'
  ];

  private function dir()
  {
    return storage_path('app/public') . "/persona/" . $this->persona->hash_dir . "/";
  }

  public function persona()
  {
    return $this->belongsTo(Persona::class);
  }

  public function getRutaPulgarDerechoAttribute()
  {
    return $this->verficaRuta($this->dir() . $this->ruta_dedo_a);
  }

  public function getRutaIndiceDerechoAttribute()
  {
    return $this->verficaRuta($this->dir() . $this->ruta_dedo_b);
  }

  public function getRutaMedioDerechoAttribute()
  {
    return $this->verficaRuta($this->dir() . $this->ruta_dedo_c);
  }

  public function getRutaAnularDerechoAttribute()
  {
    return $this->verficaRuta($this->dir() . $this->ruta_dedo_d);
  }

  public function getRutaMeniqueDerechoAttribute()
  {
    return $this->verficaRuta($this->dir() . $this->ruta_dedo_e);
  }

  public function getRutaPulgarIzquierdoAttribute()
  {
    return $this->verficaRuta($this->dir() . $this->ruta_dedo_f);
  }

  public function getRutaIndiceIzquierdoAttribute()
  {
    return $this->verficaRuta($this->dir() . $this->ruta_dedo_g);
  }

  public function getRutaMedioIzquierdoAttribute()
  {
    return $this->verficaRuta($this->dir() . $this->ruta_dedo_h);
  }

  public function getRutaAnularIzquierdoAttribute()
  {
    return $this->verficaRuta($this->dir() . $this->ruta_dedo_i);
  }

  public function getRutaMeniqueIzquierdoAttribute()
  {
    return $this->verficaRuta($this->dir() . $this->ruta_dedo_j);
  }

  public function getRutaPulgarRodadaDerechoAttribute()
  {
    return $this->verficaRuta($this->dir() . $this->ruta_rodada_a);
  }

  public function getRutaIndiceRodadaDerechoAttribute()
  {
    return $this->verficaRuta($this->dir() . $this->ruta_rodada_b);
  }

  public function getRutaMedioRodadaDerechoAttribute()
  {
    return $this->verficaRuta($this->dir() . $this->ruta_rodada_c);
  }

  public function getRutaAnularRodadaDerechoAttribute()
  {
    return $this->verficaRuta($this->dir() . $this->ruta_rodada_d);
  }

  public function getRutaMeniqueRodadaDerechoAttribute()
  {
    return $this->verficaRuta($this->dir() . $this->ruta_rodada_e);
  }

  public function getRutaPulgarRodadaIzquierdoAttribute()
  {
    return $this->verficaRuta($this->dir() . $this->ruta_rodada_f);
  }

  public function getRutaIndiceRodadaIzquierdoAttribute()
  {
    return $this->verficaRuta($this->dir() . $this->ruta_rodada_g);
  }

  public function getRutaMedioRodadaIzquierdoAttribute()
  {
    return $this->verficaRuta($this->dir() . $this->ruta_rodada_h);
  }

  public function getRutaAnularRodadaIzquierdoAttribute()
  {
    return $this->verficaRuta($this->dir() . $this->ruta_rodada_i);
  }

  public function getRutaMeniqueRodadaIzquierdoAttribute()
  {
    return $this->verficaRuta($this->dir() . $this->ruta_rodada_j);
  }

  public function getPalmarDerechoAttribute()
  {
    return $this->verficaRuta($this->dir() . $this->ruta_palmar_derecho);
  }

  public function getCantoDerechoAttribute()
  {
    return $this->verficaRuta($this->dir() . $this->ruta_canto_derecho);
  }

  public function getPalmarIzquierdoAttribute()
  {
    return $this->verficaRuta($this->dir() . $this->ruta_palmar_izquierdo);
  }

  public function getCantoIzquierdoAttribute()
  {
    return $this->verficaRuta($this->dir() . $this->ruta_canto_izquierdo);
  }

  private function verficaRuta($ruta)
  {
    $default = public_path('/img/blanco.png');

    if ($ruta == "" || ($ruta != "" && is_dir($ruta)) || ($ruta == "")) {
      return $default;
    } else {
      try {
        fopen($ruta, "r");
        return $ruta;
      } catch (\Exception $e) {
        return $default;
      }
    }
  }
}
