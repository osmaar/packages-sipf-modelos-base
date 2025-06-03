<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KibTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'persona_id',
        'payload',
        'transactions',
        'input',
        'entity',
        'response',
        'code',
        'type',
        'status',
    ];

    protected $casts = [
        'payload' => 'json',
        'transactions' => 'json',
        'input' => 'json',
        'entity' => 'json',
        'response' => 'json',
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }
}
