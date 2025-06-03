<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class ByTransfer extends FFV
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'traslados';

    public function centro()
    {
        return $this->belongsTo(Centro::class, 'centro_id', 'id');
    }

    public function centro_destino()
    {
        return $this->belongsTo(Centro::class, 'centro_destino_id', 'id');
    }

    public function centro_estatal()
    {
        return $this->belongsTo(Centro::class, 'centro_estatal', 'id');
    }

    public function centro_militar()
    {
        return $this->belongsTo(Centro::class, 'centro_militar', 'id');
    }

    public function expediente()
    {
        return $this->belongsTo(Expediente::class);
    }
    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }

    public function autoridad_ordena()
    {
        return $this->flex();
    }

    public function autoridad_judicial()
    {
        return $this->flex();
    }

    public function tipo_traslado()
    {
        return $this->flex();
    }

    public function estado()
    {
        return $this->flex();
    }
}
