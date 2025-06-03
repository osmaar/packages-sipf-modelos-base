<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IncineracionPertenencia extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        "resguardo_id",
        "folio",
        "fecha_incineracion",
        "observaciones"
    ];

    public function resguardo()
    {
        return $this->belongsTo(Resguardo::class, "reguardo_id", "id");
    }
}
