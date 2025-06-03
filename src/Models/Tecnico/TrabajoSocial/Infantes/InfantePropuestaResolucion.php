<?php

namespace Sipf\ModelosBase\Models\Tecnico\TrabajoSocial\Infantes;

use DateTime;
use DateTimeZone;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InfantePropuestaResolucion extends Model
{
  use HasFactory, SoftDeletes;

  const DATETIMEZONE = "America/Mexico_City";


  protected $table = "propuesta_egreso_resoluciones";
  protected $fillable = [
    "resolucion_file",
    "resolucion_file_nombre",
    "numero_sesion",
    "usuario_registro",
    "fecha_hora_resolucion"
  ];

  /**
   *Relaciones Eloquent
   */

  public function propuestaEgresoResolucionReferencias()
  {
    return $this->hasMany(InfantePropuestaResolucionReferecias::class, "resolucion_id");
  }


  /**
   *Scopes
   */


  /**
   *Atributos
   */

  public function getFechaHoraResolucionFormatAttribute()
  {
    $date = new DateTime($this->fecha_hora_resolucion);
    $date->setTimezone(new DateTimeZone(self::DATETIMEZONE));
    return $date->format('d/m/Y H:i');
  }

  public function getFechaHoraResolucionInputAttribute()
  {
    $date = new DateTime($this->fecha_hora_resolucion);
    $date->setTimezone(new DateTimeZone('America/Mexico_City'));
    return $date->format('Y-m-d H:i');
  }

  public function getFechaResolucionFormatAttribute()
  {
    $date = new DateTime($this->fecha_hora_resolucion);
    $date->setTimezone(new DateTimeZone('America/Mexico_City'));
    return $date->format('d/m/Y');
  }

  /**
   *Otros Métodos
   */
}
