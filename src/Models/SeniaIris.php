<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class SeniaIris extends FFV
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'senias_iris';

    protected $fillable = [
        'ojo_izquierdo',
        'ojo_derecho'
    ];

    private function _dir()
    {
        return 'storage/persona/' . $this->persona->hash_dir . '/';
    }
    public function getRutaAAttribute($value)
    {
        return ($this->ojo_derecho == "Si") ?  asset($this->_dir() . $value . '?' . time()) : null;
    }
    public function getRutaBAttribute($value)
    {
        return ($this->ojo_izquierdo == "Si") ?  asset($this->_dir() . $value . '?' . time()) : null;
    }

    public function ojo_izquierdo()
    {
        return $this->flex();
    }

    public function ojo_derecho()
    {
        return $this->flex();
    }

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }
}
