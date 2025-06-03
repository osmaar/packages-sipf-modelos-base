<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Model;

class BitacoraSolicitud extends Model
{
  protected $table = 'bitacora_solicitudes';
  protected $fillable = ['id', 'solicitud_id', 'estatus', 'user_id', 'motivo'];


  public function solicitud()
  {
    return $this->belongsTo(Solicitud::class, 'solicitud_id');
  }
}
