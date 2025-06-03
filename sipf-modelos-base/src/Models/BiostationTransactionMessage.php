<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiostationTransactionMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'biostation_transaction_id',
        'message',
        'step',
        'stack_trace',
        'status'
    ];

    protected $casts = [
        'stack_trace' => 'array'
    ];

    public function biostationTransaction()
    {
        return $this->belongsTo(BiostationTransaction::class);
    }
}
