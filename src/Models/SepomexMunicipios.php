<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SepomexMunicipios extends Model
{
    use HasFactory;

    protected $table = 'sepomex_municipios';

    public function estado()
    {
        return $this->belongsTo(SepomexEstado::class, 'c_estado', 'c_estado');
    }
    public function asentamientos()
    {
        return $this->hasMany(Sepomex::class, 'c_mnpio', 'c_mnpio');
    }
    public function colonias()
    {
        return $this->hasMany(SepomexCp::class, 'c_mnpio', 'c_mnpio');
    }
}
