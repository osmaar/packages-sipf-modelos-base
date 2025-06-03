<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class SeniaHuella extends FFV
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

    private function _dir()
    {
        return 'storage/persona/' . $this->persona->hash_dir . '/';
    }

    public function getRutaDedoAAttribute($value)
    {
        return asset($this->_dir() . $value . '?' . time());
    }
    public function getRutaDedoBAttribute($value)
    {
        return asset($this->_dir() . $value . '?' . time());
    }

    public function getRutaDedoCAttribute($value)
    {
        return asset($this->_dir() . $value . '?' . time());
    }
    public function getRutaDedoDAttribute($value)
    {
        return asset($this->_dir() . $value . '?' . time());
    }

    public function getRutaDedoEAttribute($value)
    {
        return asset($this->_dir() . $value . '?' . time());
    }
    public function getRutaDedoFAttribute($value)
    {
        return asset($this->_dir() . $value . '?' . time());
    }
    public function getRutaDedoGAttribute($value)
    {
        return asset($this->_dir() . $value . '?' . time());
    }
    public function getRutaDedoHAttribute($value)
    {
        return asset($this->_dir() . $value . '?' . time());
    }
    public function getRutaDedoIAttribute($value)
    {
        return asset($this->_dir() . $value . '?' . time());
    }
    public function getRutaDedoJAttribute($value)
    {
        return asset($this->_dir() . $value . '?' . time());
    }

    public function getRutaRodadaAAttribute($value)
    {
        return asset($this->_dir() . $value . '?' . time());
    }
    public function getRutaRodadaBAttribute($value)
    {
        return asset($this->_dir() . $value . '?' . time());
    }

    public function getRutaRodadaCAttribute($value)
    {
        return asset($this->_dir() . $value . '?' . time());
    }
    public function getRutaRodadaDAttribute($value)
    {
        return asset($this->_dir() . $value . '?' . time());
    }

    public function getRutaRodadaEAttribute($value)
    {
        return asset($this->_dir() . $value . '?' . time());
    }
    public function getRutaRodadaFAttribute($value)
    {
        return asset($this->_dir() . $value . '?' . time());
    }
    public function getRutaRodadaGAttribute($value)
    {
        return asset($this->_dir() . $value . '?' . time());
    }
    public function getRutaRodadaHAttribute($value)
    {
        return asset($this->_dir() . $value . '?' . time());
    }
    public function getRutaRodadaIAttribute($value)
    {
        return asset($this->_dir() . $value . '?' . time());
    }
    public function getRutaRodadaJAttribute($value)
    {
        return asset($this->_dir() . $value . '?' . time());
    }

    public function getRutaPalmarIzquierdoAttribute($value)
    {
        return asset($this->_dir() . $value . '?' . time());
    }

    public function getRutaPalmarDerechoAttribute($value)
    {
        return asset($this->_dir() . $value . '?' . time());
    }

    public function getRutaCantoIzquierdoAttribute($value)
    {
        return asset($this->_dir() . $value . '?' . time());
    }

    public function getRutaCantoDerechoAttribute($value)
    {
        return asset($this->_dir() . $value . '?' . time());
    }




    public function extremidad_izquierda()
    {
        return $this->flex();
    }
    public function extremidad_derecha()
    {
        return $this->flex();
    }
    public function situacion_dedo_a()
    {
        return $this->flex();
    }
    public function situacion_dedo_b()
    {
        return $this->flex();
    }
    public function situacion_dedo_c()
    {
        return $this->flex();
    }
    public function situacion_dedo_d()
    {
        return $this->flex();
    }
    public function situacion_dedo_e()
    {
        return $this->flex();
    }
    public function situacion_dedo_f()
    {
        return $this->flex();
    }
    public function situacion_dedo_g()
    {
        return $this->flex();
    }
    public function situacion_dedo_h()
    {
        return $this->flex();
    }
    public function situacion_dedo_i()
    {
        return $this->flex();
    }
    public function situacion_dedo_j()
    {
        return $this->flex();
    }

    public function extremidad_situacion_especial()
    {
        return $this->flex();
    }

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }
}
