<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonaOtroNombre extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'persona_otros_nombres';

    protected $fillable = [
        'persona_id',
        'nombre',
        'primer_apellido',
        'segundo_apellido',
        'activo'
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'persona_id', 'id');
    }
}
