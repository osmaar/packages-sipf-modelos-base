<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Historial extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'historial';

    protected $fillable = [
        'user_id',
        'persona_id',
        'centro_id',
        'expediente_id',
        'module',
        'section',
        'action',
        'model',
        'model_id',
        'data'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }
}
