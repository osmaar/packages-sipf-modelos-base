<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProcesoPena extends Model
{
  use SoftDeletes;
  use HasFactory;

  protected $table = 'proceso_pena';
  protected $fillable = [
    'proceso_id',
    'fecha_detencion',
    'fecha_vinculacion',
    'reparacion_danio',
    'multa',
    'anio',
    'mes',
    'dias',
    'estatus',
    'step',
    'step_id',
    'observacion_expediente'
  ];

  public function proceso()
  {
    return $this->belongsTo(Proceso::class, 'proceso_id');
  }

  public function sentencia()
  {
    return $this->hasOne(Sentencia::class, 'proceso_id', "proceso_id");
  }

  public function getDiasSentenciaAttribute()
  {
    $fecha_apartir_de =  new \DateTime($this->fecha_a_partir_de);
    $fecha_final =  new \DateTime($this->fecha_a_partir_de);
    $intervalo_anios = new \DateInterval("P" . $this->anio . "Y");
    $intervalo_meses = new \DateInterval("P" . $this->mes . "M");
    $intervalo_dias = new \DateInterval("P" . $this->dias . "D");
    $fecha_final = $fecha_final->add($intervalo_anios)->add($intervalo_meses)->add($intervalo_dias);
    $intervalo = $fecha_final->diff($fecha_apartir_de);
    $dias = $intervalo->format("%a");
    return (int) $dias;
  }
}
