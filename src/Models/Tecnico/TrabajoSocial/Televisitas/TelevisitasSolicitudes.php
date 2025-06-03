<?php

namespace Sipf\ModelosBase\Models\Tecnico\TrabajoSocial\Televisitas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelevisitasSolicitudes extends Model
{
    use HasFactory;

    protected $table = "televisitas_solicitudes";
    protected $primaryKey = "id";

    protected $guarded = [];
}
