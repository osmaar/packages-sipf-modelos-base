<?php

namespace Sipf\ModelosBase\Models\Tecnico\PlanActividadesPPL;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntrevistaEDSInicial extends Model
{
    use HasFactory;

    protected $table = "entrevista_eds_inicial";
    protected $primaryKey = "id";

    protected $guarded = [];
}
