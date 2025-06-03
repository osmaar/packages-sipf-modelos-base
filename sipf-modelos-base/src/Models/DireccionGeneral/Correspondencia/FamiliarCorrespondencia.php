<?php

namespace Sipf\ModelosBase\Models\DireccionGeneral\Correspondencia;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FamiliarCorrespondencia extends Model
{
    use HasFactory;

    protected $table = "familiar_correspondencia";
    protected $primaryKey = "id";

    protected $guarded = [];
}
