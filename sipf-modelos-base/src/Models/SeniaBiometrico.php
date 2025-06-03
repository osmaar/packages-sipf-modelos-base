<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class SeniaBiometrico extends FFV
{
    use HasFactory;

    protected $table = 'senias_biometricos';

    protected $fillable = ['persona_id'];

    private function _dir()
    {
        return 'storage/persona/' . $this->persona->hash_dir . '/';
    }
    public function getRutaAAttribute($value)
    {
        return asset($this->_dir() . $value . '?' . time());
    }
    public function getRutaBAttribute($value)
    {
        return asset($this->_dir() . $value . '?' . time());
    }
    public function getRutaCAttribute($value)
    {
        return asset($this->_dir() . $value . '?' . time());
    }
    // Elemento padre
    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }

    // Dentro del modelo SeniaBiometrico

    public function historial()
    {
        return $this->hasMany(SeniaBiometricoHistorial::class);
    }

    public function getRutaImagenFrenteAttribute($value)
    {
        return $this->_dir() . "/" . $this->ruta_a;
    }
}
