<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonaDiscapacidad extends FFV
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'persona_discapacidades';

    protected $fillable = [
        'persona_id',
        'discapacidad'
    ];

    public function discapacidad()
    {
        return $this->flex();
    }

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'persona_id', 'id');
    }
}
