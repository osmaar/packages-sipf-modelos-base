<?php

namespace Sipf\ModelosBase\Models\Tecnico\Seguridad\Sanciones;

use App\Models\Models\Tecnico\Seguridad\Sanciones\AmparosSancion;
use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Sipf\ModelosBase\Models\ApelacionesSancion;
use Sipf\ModelosBase\Models\Catalogos\CtgTipoSancion;
use Sipf\ModelosBase\Models\Centro;
use Sipf\ModelosBase\Models\Controversia;

class Sancion extends Model
{
  use HasFactory;
  use SoftDeletes;

  protected $table = 'sanciones';

  protected $fillable = [
    'id',
    'tipo_sancion_id',
    'centro_id',
    'consecutivo',
    'folio',
    'dias_sancion',
    'no_sesion_comite',
    'observaciones',
    'fecha_registro',
    'descripcion',
    'sancion_file_nombre',
    'sancion_file',
    'fecha_hora_inicio_sancion',
    'fecha_hora_fin_sancion',
    'fecha_hora_fin_real_sancion',
    'lugar_aplicacion',
    'atendida',
    'firmante_1_nombre',
    'firmante_1_cargo',
    'firmante_2_nombre',
    'firmante_2_cargo',
    'enviado',
    'suspendida',
    'confirmada_por_seguridad',
    'fecha_envio_seguridad',
  ];

  /**
   *Relaciones Eloquent
   */

  public function tipoSancion()
  {
    return $this->belongsTo(CtgTipoSancion::class);
  }

  public function centro()
  {
    return $this->belongsTo(Centro::class);
  }

  public function involucrados()
  {
    return $this->hasMany(SancionInvolucrado::class);
  }

  public function controversias()
  {
    return $this->hasMany(Controversia::class);
  }

  public function apelacionesSanciones()
  {
    return $this->hasMany(ApelacionesSancion::class);
  }

  public function amparosSanciones()
  {
    return $this->hasMany(AmparosSancion::class);
  }

  /**
   *Scopes
   */
  public function scopeDePersona($query, $persona_id)
  {
    $query->whereHas('involucrados', function ($query) use ($persona_id) {
      $query->whereHas('involucradoIncidente', function ($query) use ($persona_id) {
        $query->where('persona_id', $persona_id);
      });
    });
  }

  public function scopeAtendida($query)
  {
    return $query->where('atendida', 1);
  }

  public function scopeNoAtendida($query)
  {
    return $query->where('atendida', 0);
  }

  /**
   *Atributos
   */

  public function getFechaRegistroParaInputDateAttribute()
  {
    $date = date_create($this->fecha_registro);
    return date_format($date, "Y-m-d");
  }

  public function getFechaRegistroFormatAttribute()
  {
    $date = date_create($this->fecha_registro);
    return date_format($date, "d/m/Y");
  }

  public function getHoraRegistroFormatAttribute()
  {
    $date = date_create($this->created_at);
    return date_format($date, "H:i");
  }

  public function getAnioRegistroAttribute()
  {
    $date = date_create($this->fecha_registro);
    return date_format($date, "Y");
  }

  public function getInvolucradosTxtAttribute()
  {
    $nombres_completos = [];
    foreach ($this->involucrados as $involucrado) {
      $nombres_completos[] = $involucrado->involucradoIncidente?->persona?->nombre_completo;
    }

    return implode(', ', $nombres_completos);
  }

  public function getFechaHoraInicioSancionParaInputDateAttribute()
  {
    $date = date_create($this->fecha_hora_inicio_sancion);
    return date_format($date, "Y-m-d H:i");
  }

  public function getFechaHoraInicioSancionFormatAttribute()
  {
    $date = date_create($this->fecha_hora_inicio_sancion);
    return date_format($date, "d/m/Y H:i:s");
  }

  public function getFechaHoraFinSancionParaInputDateAttribute()
  {
    $date = date_create($this->fecha_hora_fin_sancion);
    return date_format($date, "Y-m-d H:i");
  }

  public function getFechaHoraFinSancionFormatAttribute()
  {
    $date = date_create($this->fecha_hora_fin_sancion);
    return date_format($date, "d/m/Y H:i:s");
  }

  public function getFechaHoraFinRealSancionParaInputDateAttribute()
  {
    $date = date_create($this->fecha_hora_fin_real_sancion);
    return date_format($date, "Y-m-d H:i");
  }

  public function getFechaHoraFinRealSancionFormatAttribute()
  {
    $date = date_create($this->fecha_hora_fin_real_sancion);
    return date_format($date, "d/m/Y H:i:s");
  }

  public function getDiasSancionAttribute()
  {
    $fechaInicio = $this->fecha_hora_inicio_sancion;
    $fechaFin = $this->fecha_hora_fin_sancion;

    $inicio = new DateTime($fechaInicio);
    $fin = new DateTime($fechaFin);

    // Calcula la cantidad de días de diferencia
    $diferencia = $inicio->diff($fin);

    // Devuelve la cantidad de días
    return $diferencia->days;
  }

  public function getAtiendeAttribute()
  {
    if ($this->revisa_consejo_tecnico == 1) {
      return 'Comité Técnico';
    } else {
      return 'Jurídico';
    }
  }

  /*-------------------------------- ESTAPAS Y ESTATUS DE SANCION ------------------------------*/
  public function getEtapaSancionAttribute()
  {
    $hoy = now();

    // 1. Si está suspendida, esa es la prioridad
    if ($this->suspendida) {
      return "Suspendida";
    }

    // 0.3 Tiene amparo
    if ($this->amparosSanciones()->exists()) {
      if ($this->amparosSanciones()->where('enviado_comite', 0)->exists()) {
        return "Pendiente de envío a comité técnico";
      }
      if ($this->amparosSanciones()->where('enviado_comite', 1)->exists()) {
        return "En espera de resolución de comité";
      } else if ($this->amparosSanciones()->where('enviado_comite', 2)->exists()) {
        return "Con resolución del comité técnico";
      } else if ($this->amparosSanciones()->where('enviado_comite', 3)->exists()) {
        return "Enviado a seguridad";
      }
    }

    // 0.1 Tiene controversia
    // dd($this->controversias()->where('en_comite', 2)->exists());
    if ($this->controversias()->exists() && !$this->apelacionesSanciones()->exists()) {
      if ($this->controversias()->where('en_comite', null)->exists()) {
        return "Pendiente de envío a comité técnico";
      }
      if ($this->controversias()->where('en_comite', 1)->exists()) {
        return "En espera de la resolución de la controversia";
      } else if ($this->controversias()->where('en_comite', 2)->exists()) {
        return "Con resolución del comité técnico";
      } else if ($this->controversias()->where('en_comite', 3)->exists()) {
        return "Enviado a seguridad";
      }
    }

    if ($this->apelacionesSanciones()->exists()) {
      if ($this->apelacionesSanciones()->where('en_comite', null)->exists()) {
        return "Pendiente de envío a comité técnico";
      }
      if ($this->apelacionesSanciones()->where('en_comite', 1)->exists()) {
        return "En espera de la resolución de la apelación";
      } else if ($this->apelacionesSanciones()->where('en_comite', 2)->exists()) {
        return "Con resolución del comité técnico";
      } else if ($this->apelacionesSanciones()->where('en_comite', 3)->exists()) {
        return "Enviado a seguridad";
      }
    }

    // 1.1. Enviado
    if ($this->enviado) {
      return "Enviado a seguridad";
    }

    // 1.2. Pendiente de envío
    if ($this->sancion_file && !$this->enviado) {
      return "Pendiente de envío a seguridad";
    }

    // 2. Si la fecha fin real existe y ya pasó
    if ($this->fecha_hora_fin_real_sancion && $hoy >= $this->fecha_hora_fin_real_sancion) {
      return "Finalizada";
    }

    // 3. Si no hay fecha fin real pero la fecha fin programada ya pasó
    if (!$this->fecha_hora_fin_real_sancion && $this->fecha_hora_fin_sancion && $hoy >= $this->fecha_hora_fin_sancion) {
      return "Finalizada";
    }

    // 4. Si está en ejecución (inicio <= hoy < fin real o programada)
    if (
      $this->fecha_hora_inicio_sancion &&
      $this->fecha_hora_inicio_sancion <= $hoy &&
      (
        (!$this->fecha_hora_fin_real_sancion && $this->fecha_hora_fin_sancion && $hoy < $this->fecha_hora_fin_sancion) ||
        ($this->fecha_hora_fin_real_sancion && $hoy < $this->fecha_hora_fin_real_sancion)
      )
    ) {
      return "En ejecución";
    }

    // 5. Si esta enviada a comite tecnico.



    return "En espera de inicio de sanción";
  }


  public function getEstatusSancionAttribute()
  {
    if ($this->tipoSancion?->descripcion == "SIN EFECTO") {
      return "Sin efecto";
    }

    return "Con efecto";
  }
  /*------------------------------------------------------------------------*/

  /*-------------------------------- TIPO DE RESOLUCIONES ACCESSORS ------------------------------*/

  public function getPasaronTresDiasSancionAttribute()
  {
    $isReturn = false;
    if ($this->fecha_envio_seguridad) {
      $fechaInicio = $this->fecha_envio_seguridad;
      $hoy = now();
      $isReturn = $hoy->diffInHours($fechaInicio, false) <= -72;
    }
    return $isReturn;
  }
  public function getPasaronTresDiasApelacionAttribute()
  {
    $isReturn = false;
    if ($this->apelacionesSanciones()->exists()) {
      $apelacion = $this->apelacionesSanciones()->first();
      $fechaInicio = $apelacion->fecha_envio_seguridad;
      $hoy = now();
      $isReturn = $hoy->diffInHours($fechaInicio, false) <= -72;
    }
    return $isReturn;
  }

  public function getPasaronTresDiasControversiaAttribute()
  {
    if ($this->controversias()->exists()) {
      $amparo = $this->controversias()->first();
      $fechaInicio = $amparo->fecha_envio_seguridad instanceof \Carbon\Carbon
        ? $amparo->fecha_envio_seguridad
        : \Carbon\Carbon::parse($amparo->fecha_envio_seguridad);
      return $fechaInicio->diffInHours(now()) >= 72;
    }
    return false;
  }


  public function getPasaronTresDiasAmparoAttribute()
  {
    $isReturn = false;
    if ($this->amparosSanciones()->exists()) {
      $controversia = $this->amparosSanciones()->first();
      $fechaInicio = $controversia->fecha_envio_seguridad;
      $hoy = now();
      $isReturn = $hoy->diffInHours($fechaInicio, false) <= -72;
    }
    return $isReturn;
  }

  public function getResolucionControversiaGuardadaAttribute()
  {
    return $this->controversias()->exists();
  }

  public function getResolucionApelacionGuardadaAttribute()
  {
    return $this->apelacionesSanciones()->exists(); // true si tiene una apelación
  }

  public function getResolucionAmparoGuardadaAttribute()
  {
    return $this->amparosSanciones()->exists(); // true si tiene al menos un amparo
  }

  /*------------------------------------------------------------------------*/

  /**
   *Otros Métodos
   */

  public static function calcularFolio($centro_id, $anio, $consecutivo)
  {
    $centro = Centro::find($centro_id);
    $nomenclatura_centro = rtrim($centro->nomenclatura_centro, "/");
    $folio = "SAN/" . $nomenclatura_centro . "/" . sprintf("%06d", $consecutivo) . "/" . $anio;
    return $folio;
  }

  public static function calcularConsecutivo($centro_id, $anio)
  {
    $consecutivo = 1;
    $incidente = Sancion::where("centro_id", "=", $centro_id)
      ->whereYear("fecha_registro", $anio)
      ->select("consecutivo")
      ->orderBy('consecutivo', 'DESC')->first();
    if ($incidente) {
      $ultimo_consecutivo = $incidente->consecutivo;
      $consecutivo = intval($ultimo_consecutivo) + 1;
    }
    return $consecutivo;
  }
}
