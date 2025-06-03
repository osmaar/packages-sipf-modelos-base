<?php

namespace Sipf\ModelosBase\Models\Tecnico\TrabajoSocial\Infantes;

use DateTime;
use DateTimeZone;
use Sipf\ModelosBase\Models\Referencia;
use Sipf\ModelosBase\Models\Expediente;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Sipf\ModelosBase\Models\Catalogos\CtgEstatusPropuestaEgresoInfante;

class InfantePropuesta extends Model
{
  use HasFactory, SoftDeletes;

  protected $table = "propuesta_referencias_egreso";
  protected $fillable = [
    "referencia_id",
    "solicitud_file",
    "solicitud_file_nombre",
    "estatus_id",
    "activa",
    "usuario_registro",
    "usuario_cancelo",
    "motivo_cancelacion",
    "fecha_hora_cancelacion",
    "fecha_hora_registro"
  ];

  public $rules = [];
  const DATETIMEZONE = "America/Mexico_City";

  /**
   *Relaciones Eloquent
   */
  public function referencia()
  {
    return $this->belongsTo(Referencia::class);
  }

  public function estatus()
  {
    return $this->belongsTo(CtgEstatusPropuestaEgresoInfante::class, "estatus_id");
  }

  public function referenciaInfantes()
  {
    return $this->hasMany(InfantePropuestaInfante::class, "propuesta_id");
  }

  public function propuestaResolucionReferencia()
  {
    return $this->hasOne(InfantePropuestaResolucionReferecias::class, "propuesta_id");
  }

  /**
   *Scopes
   */

  public function scopePorExpediente($query, $expediente_id)
  {
    $expediente = Expediente::find($expediente_id);

    $query->whereHas("referencia", function ($query) use ($expediente) {
      $query->whereHas("visitasFamiliares", function ($query) use ($expediente) {
        $query->where("persona_id", "=", $expediente->persona_id);
      })
        ->orwhereHas("visitasExternas", function ($query) use ($expediente) {
          $query->whereHas("visitasExternasPPL", function ($query) use ($expediente) {
            $query->where("persona_id", "=", $expediente->persona_id);
          });
        });
    });

    return $query;
  }

  public function scopeActivaPorExpediente($query, $expediente_id)
  {
    $expediente = Expediente::find($expediente_id);

    $query->whereIn("estatus_id", [1, 2, 3, 4])->whereHas("referencia", function ($query) use ($expediente) {
      $query->whereHas("visitasFamiliares", function ($query) use ($expediente) {
        $query->where("persona_id", "=", $expediente->persona_id);
      })
        ->orwhereHas("visitasExternas", function ($query) use ($expediente) {
          $query->whereHas("visitasExternasPPL", function ($query) use ($expediente) {
            $query->where("persona_id", "=", $expediente->persona_id);
          });
        });
    });

    return $query;
  }


  /**
   *Atributos
   */

  public function getSituacionAttribute()
  {
    if ($this->activa) {
      return "Activa";
    } else {
      return "Inactiva";
    }
  }

  public function getFechaHoraRegistroFormatAttribute()
  {
    $date = new DateTime($this->fecha_hora_registro);
    $date->setTimezone(new DateTimeZone(self::DATETIMEZONE));
    return $date->format('d/m/Y H:i');
  }

  public function getFechaHoraRegistroInputAttribute()
  {
    $date = new DateTime($this->fecha_hora_registro);
    $date->setTimezone(new DateTimeZone(self::DATETIMEZONE));
    return $date->format('Y-m-d H:i');
  }

  public function getFechaRegistroAttribute()
  {
    $date = date_create($this->fecha_hora_registro);
    return date_format($date, "Y-m-d");
  }

  public function getFechaRegistroFormatAttribute()
  {
    $date = date_create($this->fecha_hora_registro);
    return date_format($date, "d/m/Y");
  }

  public function getHoraRegistroAttribute()
  {
    $date = date_create($this->fecha_hora_registro);
    return date_format($date, "H:i");
  }

  public function getFechaHoraCancelacionFormatAttribute()
  {
    $date = new DateTime($this->fecha_hora_cancelacion);
    $date->setTimezone(new DateTimeZone(self::DATETIMEZONE));
    return $date->format('d/m/Y H:i');
  }

  public function getFechaHoraCancelacionInputAttribute()
  {
    $date = new DateTime($this->fecha_hora_cancelacion);
    $date->setTimezone(new DateTimeZone(self::DATETIMEZONE));
    return $date->format('Y-m-d H:i');
  }

  public function getFechaCancelacionAttribute()
  {
    $date = date_create($this->fecha_hora_cancelacion);
    return date_format($date, "Y-m-d");
  }

  public function getFechaCancelacionFormatAttribute()
  {
    $date = date_create($this->fecha_hora_cancelacion);
    return date_format($date, "d/m/Y");
  }

  public function getHoraCancelacionAttribute()
  {
    $date = date_create($this->fecha_hora_cancelacion);
    return date_format($date, "H:i");
  }


  /**
   *Otros Métodos
   */
}
