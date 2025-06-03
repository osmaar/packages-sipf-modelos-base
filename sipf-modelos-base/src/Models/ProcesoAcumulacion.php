<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ProcesoAcumulacion extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'proceso_acumulacion';

    public function detalle()
    {
        return $this->hasMany(ProcesoAcumulacion::class);
    }
    protected $fillable = [
        'id',
        'proceso_id',
        'fecha_acumulacion',
        'motivo_acumulacion',
    ];
    protected $dates = ['deleted_at'];

    public static $rules = [
        'id' => 'integer',
        'fecha_acumulacion' => 'date',
        'motivo_acumulacion' => 'string|max:500',
    ];
}
