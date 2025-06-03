<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CentrosNumConsecutivo extends Model
{
    use HasFactory;
    protected $fillable = [
        'centro_id',
        'folio',
        'status'
    ];
}
