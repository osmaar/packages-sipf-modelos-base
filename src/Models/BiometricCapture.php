<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Model;

class BiometricCapture extends Model
{
    protected $table = 'biometric_captures';

    protected $fillable = [
        'persona_id',
        'data',
        'tcn',
    ];

    protected $cast = [
        'data' => 'array',
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }
}
