<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bitacora extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'bitacora';

    protected $fillable = [
        'user_id',
        'persona_id',
        'centro_id',
        'expediente_id',
        'num_expediente',
        'module',
        'section',
        'cmd',
        'description',
        'table',
        'table_id',
        'content'
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
