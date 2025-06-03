<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonaPadre extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'persona_padres';

    protected $fillable = [
        'persona_id',
        'parentesco',
        'nombre',
        'primer_apellido',
        'segundo_apellido',
        'finado'
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'persona_id', 'id');
    }
}
