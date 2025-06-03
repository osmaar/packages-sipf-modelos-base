<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SepomexCp extends Model
{
    use HasFactory;

    protected $table = 'sepomex_cp';

    protected $casts = [
        'c_estado' => 'int',
        'd_codigo' => 'int'
    ];

    public function estado()
    {
        return $this->belongsTo(SepomexEstado::class, 'c_estado', 'c_estado');
    }
    public function getMunicipio()
    {
        return SepomexMunicipios::where('c_mnpio', $this->c_mnpio)
            ->where('c_estado', $this->c_estado)
            ->first();
    }

    public function municipio()
    {
        return $this->belongsTo(SepomexMunicipios::class, 'c_mnpio', 'c_mnpio');
    }
    public function asentamientos()
    {
        return $this->hasMany(Sepomex::class, 'id_asenta_cpcons', 'id_asenta_cpcons');
    }
}
