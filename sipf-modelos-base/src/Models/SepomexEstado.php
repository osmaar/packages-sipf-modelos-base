<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SepomexEstado extends Model
{
    use HasFactory;

    protected $table = 'sepomex_estados';
    protected $primaryKey = "c_estado";

    protected $casts = [
        'c_estado' => 'int',
    ];

    public function municipios()
    {
        return $this->hasMany(SepomexMunicipios::class, 'c_estado', 'c_estado');
    }
    public function asentamientos()
    {
        return $this->hasMany(Sepomex::class, 'c_estado', 'c_estado');
    }
    public function colonias()
    {
        return $this->hasMany(SepomexCp::class, 'c_estado', 'c_estado');
    }
}
