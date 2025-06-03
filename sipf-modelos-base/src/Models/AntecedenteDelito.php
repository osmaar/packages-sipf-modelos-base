<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class AntecedenteDelito extends FFV
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'antecedente_delitos';

    protected $fillable = [
        'antecedente_id',
        'delito',
        'modalidad_delito',
        'fecha_comision',
        'como_dicta_juez'
    ];

    public function delito()
    {
        return $this->flex();
    }

    public function modalidad_delito()
    {
        return $this->flex();
    }

    public function antecedente()
    {
        return $this->belongsTo(Antecedente::class);
    }
}
