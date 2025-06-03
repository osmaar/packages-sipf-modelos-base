<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class VisitaExternaPPL extends FFV
{
    use HasFactory;

    protected $table = 'visita_externa_ppls';
    protected $guarded = [];

    public function estatus_persona()
    {
        return $this->flex();
    }

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }
}
