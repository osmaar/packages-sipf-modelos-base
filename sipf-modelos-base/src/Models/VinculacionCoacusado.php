<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class VinculacionCoacusado extends FFV
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'vinculacion_coacusados';

    protected $fillable = [
        'vinculacion_id',
        'nombre',
        'primer_apellido',
        'segundo_apellido',
        'alias',
        'pertenece_centro',
        'id_persona',
        'value'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $rules = [
        'vinculacion_id' => 'integer|required',
        'nombre' => 'string|max:255',
        'primer_apellido' => 'string|max:100',
        'segundo_apellido' => 'string|max:100',
        'alias' => 'string|max:100',
        'pertenece_centro' => 'in:Si,No'
    ];

    public function vinculacion()
    {
        return $this->belongsTo(Vinculacion::class);
    }

    public function proceso()
    {
        return $this->belongsTo(Proceso::class, 'vinculacion_id', 'id');
    }
}
