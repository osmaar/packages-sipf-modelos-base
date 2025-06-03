<?php

namespace Sipf\ModelosBase\Models\Tecnico\Seguridad\Incidentes;

use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\DB;
use Sipf\ModelosBase\Models\Centro;
use Illuminate\Database\Eloquent\Model;
use Sipf\ModelosBase\Models\Expediente;
use Sipf\ModelosBase\Models\ArticuloLey;
use Sipf\ModelosBase\Models\Controversia;
use Sipf\ModelosBase\Models\LeyAplicable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Sipf\ModelosBase\Models\ApelacionesSancion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Sipf\ModelosBase\Models\CatalogosFlexFields\TipoIncidente;
use Sipf\ModelosBase\Models\Tecnico\Seguridad\Sanciones\Sancion;
use App\Models\Models\Tecnico\Seguridad\Sanciones\AmparosSancion;
use Sipf\ModelosBase\Models\Tecnico\Seguridad\Sanciones\SancionInvolucrado;

class Incidente extends Model
{
  use HasFactory;
  use SoftDeletes;

  protected $table = 'incidentes';

  protected $fillable = [
    'centro_id',
    'consecutivo',
    'folio',
    'fecha_hora_registro',
    'persona_registra',
    'persona_registra_cargo',
    'lugar_incidente',
    'descripcion_incidente',
    'revisa_consejo_tecnico',
    'incidente_file_nombre',
    'incidente_file',
    'incidente_acta_file_nombre',
    'incidente_acta_file',
    'numero_reporte',
    'firmante_1_nombre',
    'firmante_1_cargo',
    'firmante_2_nombre',
    'firmante_2_cargo',
    'atendido',
    'confirmada_por_comite_tecnico',
    'sancion_sin_efecto',
    'tipo_incidencia_ley_aplicable',
    'tipo_incidencia_articulo_aplicable',
    'sancion_sin_efecto'
  ];

  public $rules = [];


  /**
   *Relaciones Eloquent
   */

  public function ley()
  {
    return $this->belongsTo(LeyAplicable::class, 'tipo_incidencia_ley_aplicable');
  }

  public function articulo()
  {
    return $this->belongsTo(ArticuloLey::class, 'tipo_incidencia_articulo_aplicable');
  }

  public function centro()
  {
    return $this->belongsTo(Centro::class);
  }

  public function tipoIncidente()
  {
    return $this->belongsTo(TipoIncidente::class);
  }

  public function involucrados()
  {
    return $this->hasMany(IncidenteInvolucrado::class);
  }

  public function involucradosParaSancion()
  {
    return $this->hasMany(IncidenteInvolucrado::class);
  }

  public function involucradoSesion()
  {
    return $this->hasOne(IncidenteInvolucrado::class)
      ->pplSesion();
  }

  public function sancionesInvolucrados()
  {
    return $this->hasMany(SancionInvolucrado::class);
  }

  public function sanciones()
  {
    return $this->hasManyThrough(
      Sancion::class,
      SancionInvolucrado::class,
      'incidente_id',
      'id',
      'id',
      'sancion_id'
    )
      ->distinct();
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

  public function scopePorExpediente($query, $expediente_id)
  {
    $expediente = Expediente::find($expediente_id);
    $query->where("centro_id", "=", $expediente->centro_id);
    $query->whereHas('involucrados', function ($query) use ($expediente) {
      $query->where("persona_id", "=", $expediente->persona_id);
    });
  }

  public function scopePorExpedienteEnviado($query, $expediente_id)
  {
    $expediente = Expediente::find($expediente_id);
    $query->where("centro_id", "=", $expediente->centro_id);
    $query->whereHas('involucrados', function ($query) use ($expediente) {
      $query->where("persona_id", "=", $expediente->persona_id);
    })->where('enviado', true);
  }


  public function scopePorCentro($query, $centro_id)
  {
    $query->where("centro_id", "=", $centro_id);
  }

  public function scopePorCentroEnviado($query, $centro_id)
  {
    $query->where(function ($q) use ($centro_id) {
      $q->where('centro_id', $centro_id)
        ->where('enviado', true)
        ->orWhereExists(function ($sub) use ($centro_id) {
          $sub->select(DB::raw(1))
            ->from('controversias')
            ->whereColumn('controversias.incidente_id', 'incidentes.id')
            ->limit(1);
        });
    });
  }

  public function scopeRutaAccesso($query, $tipo_ruta)
  {
    $include = request()->input('include');
    $persona_id = null;

    if (preg_match('/persona_id\((\d+)\)/', $include, $matches)) {
      $persona_id = $matches[1];
    }

    if ($tipo_ruta == "juridico-sanciones" && $persona_id == null) {
      $query->whereSancionSinEfecto(false);
    }
  }


  public function scopeId($query, $id)
  {
    $query->where("id", "=", $id);
  }

  /**
   *Atributos
   */

  public function getFechaHoraRegistroFormatAttribute()
  {
    $date = new DateTime($this->fecha_hora_registro);
    $date->setTimezone(new DateTimeZone('America/Mexico_City'));
    return $date->format('d/m/Y H:i');
  }

  public function getFechaHoraRegistroInputAttribute()
  {
    $date = new DateTime($this->fecha_hora_registro);
    $date->setTimezone(new DateTimeZone('America/Mexico_City'));
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

  public function getAnioRegistroAttribute()
  {
    $date = date_create($this->fecha_hora_registro);
    return date_format($date, "Y");
  }

  /*-------------------------------- ESTATUS INCIDENCIAS Y REVISAR LAS SANCIONES DE UN INCIDENTE  ------------------------------*/

  public function getEstatusAttribute()
  {

    if ($this->sancion_sin_efecto) {
      return 'Sanción no vista por comité técnico';
    }

    $estatus = 'Sin estatus definido';
    if ($this->controversias->count() > 0 && $this->apelacionesSanciones->count() < 1) {
      if ($this->controversias()->first()->en_comite < 3) {
        $estatus = 'En atención';
      } else {
        $estatus = 'Con resolución del comité técnico';
      }
    } else if ($this->apelacionesSanciones->count() > 0 && $this->amparosSanciones->count() < 1) {
      if ($this->apelacionesSanciones()->first()->en_comite < 3) {
        $estatus = 'En atención';
      } else {
        $estatus = 'Con resolución del comité técnico';
      }
    } else if ($this->amparosSanciones->count() > 0) {
      if ($this->amparosSanciones()->first()->enviado_comite < 3) {
        $estatus = 'En atención';
      } else {
        $estatus = 'Con resolución del comité técnico';
      }
    } else if (is_null($this->incidente_file_nombre)) {
      $estatus = 'Registrado';
    } elseif (!is_null($this->incidente_file_nombre) && !$this->enviado) {
      $estatus = 'Pendiente de enviar';
    } elseif ($this->enviado && $this->atendido == 0 && $this->revisa_consejo_tecnico == 0) {
      $estatus = 'Pendiente de atención por jurídico';
    } elseif ($this->enviado && $this->atendido == 0 && $this->revisa_consejo_tecnico == 1) {
      $estatus = 'En atención (comité técnico)';
    } elseif ($this->enviado && $this->atendido == 1 && $this->revisa_consejo_tecnico == 0) {
      $estatus = 'Atendido por jurídico';
    } elseif ($this->enviado && $this->atendido == 1 && $this->revisa_consejo_tecnico == 1) {
      $estatus = 'Con resolución del comité técnico';
    }

    return $estatus;
  }



  public function puedeEnviarTodasASeguridad()
  {
    $sanciones = $this->sanciones;
    if ($sanciones->count() <= 1) {
      return false;
    }

    return $sanciones->every(function ($sancion) {
      return $sancion->etapa_sancion === 'Pendiente de envío a seguridad';
    });
  }

  /*------------------------------------------------------------------------*/




  /**
   *Otros Métodos
   */

  public static function calcularFolio($centro_id, $anio, $consecutivo)
  {
    $centro = Centro::find($centro_id);
    $nomenclatura_centro = rtrim($centro->nomenclatura_centro, "/");
    $folio = "INC/" . $nomenclatura_centro . "/" . sprintf("%06d", $consecutivo) . "/" . $anio;
    return $folio;
  }

  public static function calcularConsecutivo($centro_id, $anio)
  {
    $consecutivo = 1;
    $incidente = Incidente::where("centro_id", "=", $centro_id)
      ->whereYear("fecha_hora_registro", $anio)
      ->select("consecutivo")
      ->orderBy('consecutivo', 'DESC')->first();
    if ($incidente) {
      $ultimo_consecutivo = $incidente->consecutivo;
      $consecutivo = intval($ultimo_consecutivo) + 1;
    }
    return $consecutivo;
  }
}
