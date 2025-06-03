<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiostationBiodata extends Model
{
    use HasFactory;

    protected $fillable = [
        'biostation_transaction_id',
        'biodata'
    ];

    protected $casts = [
        'biodata' => 'array'
    ];

    public function biostationTransaction()
    {
        return $this->belongsTo(BiostationTransaction::class);
    }
}
