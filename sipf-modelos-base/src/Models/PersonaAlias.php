<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonaAlias extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'persona_alias';

    protected $fillable = [
        'persona_id',
        'alias'
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'persona_id', 'id');
    }
}
