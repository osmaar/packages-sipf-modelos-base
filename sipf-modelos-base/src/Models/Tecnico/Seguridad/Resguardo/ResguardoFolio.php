<?php

namespace Sipf\ModelosBase\Models\Tecnico\Seguridad\Resguardo;

use DateTime;
use DateTimeZone;
use App\Services\SessionService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Sipf\ModelosBase\Models\Centro;
use Sipf\ModelosBase\Models\DireccionGeneral\Correspondencia\RecepcionCorrespondencia;
use Sipf\ModelosBase\Models\Expediente;
use Sipf\ModelosBase\Models\User;

class ResguardoFolio extends Model
{
  const REQUIRED_INTEGER = "required|integer";

  use HasFactory;
  use SoftDeletes;

  protected $table = "resguardo_folios";

  protected $fillable = [
    "expediente_id",
    "centro_id",
    "folio_resguardo",
    "tipo_resguardo",
    "folio_correspondencia_id",
    "fecha",
    "fecha_dia_resguardo",
    "hora",
    "sin_pertenencias",
    "responsable",
    "nombre_ppl",
    "peticion_ppl",

    ############  F I L E S
    "pathFilePertenencias",
    "nameRecepcionFile",
    "nameEntregaFile",
    "nameIncineracionFile",

    ############  E N T R E G A
    "fecha_entrega",
    "hora_entrega",
    "tipo_entrega",
    "parentesco_entrega",
    "nombre_familiar",
    "descripcion_entrega",
    "entrega_a",
    "observaciones_entrega",

    ###########   I N C I N E R A C I O N
    "fecha_incineracion",
    "hora_incineracion",
    "realiza_incineracion",
    "autoriza_incineracion",
    "observaciones_incineracion",
    "close"
  ];
  public $rules = [

    "responsable" => self::REQUIRED_INTEGER,
    "nombre_ppl" => 'max:150',
    "centro_id" => self::REQUIRED_INTEGER,
    "folio_reguardo" => 'required|string|max:20',
    "tipo_resguardo" => self::REQUIRED_INTEGER,
    "fecha"  => 'required|date',
    "hora" => "required|date_format:H:i:s",
    "close" => self::REQUIRED_INTEGER,
  ];

  /**
   *Relaciones Eloquent
   */

  public function fullFolio()
  {
    return $this->folio_reguardo . '-';
  }

  public function tipo_resguardo()
  {
    return $this->flex();
  }

  public function expediente()
  {
    return $this->belongsTo(Expediente::class);
  }
  public function resguardoPertenenciasObjetos()
  {
    return $this->hasMany(ResguardoPertenenciaObjeto::class, 'folio_resguardo_id');
  }

  public function objetos()
  {
    return $this->hasMany(ResguardoPertenenciaObjeto::class, 'folio_resguardo_id');
  }
  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function centro()
  {
    return $this->belongsTo(Centro::class, 'centro_id');
  }

  public function correspondencia()
  {
    return $this->belongsTo(RecepcionCorrespondencia::class, 'folio_correspondencia_id');
  }

  public function entregasIncineraciones()
  {
    return $this->hasMany(ResguardoEntregaIncineracion::class, "folio_resguardo_id", "id");
  }

  /**
   *Scopes
   */

  public function scopePorCentro($query, $id_centro)
  {
    return $query->where("centro_id", "=", $id_centro);
  }

  public function scopePorExpediente($query, $id_expediente)
  {
    return $query->where("expediente_id", "=", $id_expediente);
  }

  public function scopeSinExpediente($query)
  {
    return $query->whereNull("expediente_id");
  }

  public function scopeDisponibleDatosGenerales($query, $id_expediente = 0)
  {
    $centro_id = SessionService::ses('centro');

    return $query->where("centro_id", "=", $centro_id)
      ->where('tipo_resguardo', '=', 1)
      ->where(function ($query) use ($id_expediente) {
        $query->where("expediente_id", "=", $id_expediente)
          ->orWhereNull("expediente_id");
      })
      ->where(function ($query) use ($id_expediente) {
        $query->where("sin_pertenencias", "=", 1)
          ->orWhereNotNull("nameRecepcionFile");
      });
  }

  /**
   *Atributos
   */

  public function getFechaFormatAttribute()
  {
    $date = new DateTime($this->fecha . " " . $this->hora);
    $date->setTimezone(new DateTimeZone('America/Mexico_City'));
    return $date->format('d/m/Y');
  }

  public function getHoraFormatAttribute()
  {
    $date = new DateTime($this->fecha . " " . $this->hora);
    $date->setTimezone(new DateTimeZone('America/Mexico_City'));
    return $date->format('H:i');
  }

  /**
   *Otros Métodos
   */
}
