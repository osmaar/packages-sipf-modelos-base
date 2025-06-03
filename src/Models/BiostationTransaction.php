<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiostationTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'payload',
        'response',
        'type',
        'status',
        'comment',
        'input',
        'persona_id',
        'user_id'
    ];

    protected $casts = [
        'payload' => 'array',
        'response' => 'array',
        'input' => 'array'
    ];

    public function getResponseAttribute($value)
    {
        return json_decode($value, true);
    }

    public function setResponseAttribute($value)
    {
        $this->attributes['response'] = json_encode($value);
    }

    public function biostationBiodata()
    {
        return $this->hasOne(BiostationBiodata::class);
    }
}
