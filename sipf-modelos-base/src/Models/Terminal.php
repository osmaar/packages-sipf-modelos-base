<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Terminal extends Model
{
    use HasFactory;
    protected $table = 'terminales';

    protected $fillable = [
        'id',
        'ip',
        'centro_id',
        'nombre',
        'descripcion',
        'token',
        'status',
    ];

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function centro(): BelongsTo
    {
        return $this->belongsTo(Centro::class, 'centro_id');
    }

    public function configurations()
    {
        return $this->hasMany(Configuracion::class, 'terminal_id');
    }
}
