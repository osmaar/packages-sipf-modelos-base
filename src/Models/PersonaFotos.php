<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonaFotos extends Model
{
    use HasFactory;

    protected $table = 'persona_fotos';

    protected $fillable = [
        'persona_id',
        'frontal',
        'lateral_izq',
        'lateral_der',
        'observaciones',
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'persona_id', 'id');
    }
}
