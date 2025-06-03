<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RegistroAsistenciaActividad extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "registro_asistencia_actividad";
    protected $primaryKey = "id";

    protected $guarded = [];
}
