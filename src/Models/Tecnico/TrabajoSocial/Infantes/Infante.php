<?php

namespace Sipf\ModelosBase\Models\Tecnico\TrabajoSocial\Infantes;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Infante extends Model
{
  use HasFactory, SoftDeletes;

  protected $table = "infantes";
  protected $fillable = [];

  public $rules = [];

  public function getNombreCompletoAttribute()
  {
    return $this->nombre . " " . $this->primer_apellido . " " . $this->segundo_apellido;
  }

  public function getEdadAttribute()
  {
    $fecha1 = new DateTime($this->fecha_nacimiento);
    $fecha2 = new DateTime();
    $interval = $fecha1->diff($fecha2);
    return $interval->format('%y años, %m meses, %d días');
  }
}
