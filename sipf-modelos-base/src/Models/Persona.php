<?php

namespace Sipf\ModelosBase\Models;

use DateTime;
use DateTimeZone;
use App\Models\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Sipf\ModelosBase\Models\CatalogosFlexFields\Escolaridad;
use Sipf\ModelosBase\Models\CatalogosFlexFields\EstadoCivil;
use Sipf\ModelosBase\Models\CatalogosFlexFields\Etnia;
use Sipf\ModelosBase\Models\CatalogosFlexFields\Nacionalidad;
use Sipf\ModelosBase\Models\CatalogosFlexFields\Ocupacion;
use Sipf\ModelosBase\Models\CatalogosFlexFields\Pais;
use Sipf\ModelosBase\Models\CatalogosFlexFields\Religion;
use Sipf\ModelosBase\Models\Tecnico\Criminologia\AnalisisRiesgo;
use Sipf\ModelosBase\Models\Tecnico\Criminologia\UbicacionReubicacion;
use Sipf\ModelosBase\Models\Tecnico\PlanActividadesPPL\EntrevistaLaboral;
use Sipf\ModelosBase\Models\Tecnico\Seguridad\Incidentes\IncidenteInvolucrado;
use Sipf\ModelosBase\Models\Tecnico\TrabajoSocial\Comunicacion\Correspondencia\SolicitudEnvio;
use Sipf\ModelosBase\Models\Tecnico\TrabajoSocial\Pases\Pase;

class Persona extends FFV
{
  use SoftDeletes;
  use HasFactory, Searchable;

  public $camposBusqueda = ['nombre', 'primer_apellido', 'segundo_apellido'];

  protected $appends = [
    'photo',
    'nombre_completo',
    'ubicacion_descripcion',
  ];

  protected $fillable = [
    //'id', habilitar para poder agregar id manualmente temporales, se debe quitar para que se genere automaticamente autoincremental
    'nombre',
    'primer_apellido',
    'segundo_apellido',
    'fecha_nacimiento',
    'pais_nacimiento',
    'entidad_nacimiento',
    'municipio_nacimiento',
    'rfc',
    'curp',
    'estado_civil',
    'sexo',
    'identidad_genero',
    'nacionalidad',
    'escolaridad',
    'religion',
    'ocupacion',
    'otra_ocupacion',
    'etnia',
    'otra_etnia',
    'analfabeta',
    'indigena',
    'ultimo_expediente',
    'ultimo_centro',
    'lengua_indigena',
    'enfermedad_mental',
    'readonly_info',
    'readonly_senia',
    'readonly_biometrico',
    'cib',
    'tcn',
    'verificacion_identidad'
  ];

  /**
   *Relaciones Eloquent
   */

  public function solicitudEnvio()
  {
    return $this->hasMany(SolicitudEnvio::class, 'persona_id', 'id');
  }


  public function seniaBiometrico()
  {
    return $this->hasOne(SeniaBiometrico::class);
  }

  public function seniaRostro()
  {
    return $this->hasOne(\App\Models\Ingresos\SeniaBiometrico::class);
  }

  public function pases()
  {
    return $this->hasMany(Pase::class, "persona_id", "id");
  }

  public function escolaridad()
  {
    return $this->flex();
  }

  public function religion()
  {
    return $this->flex();
  }

  public function ocupacion()
  {
    return $this->flex();
  }

  public function etnia()
  {
    return $this->flex();
  }

  public function nacionalidad()
  {
    return $this->flex();
  }

  public function nacionalidadNF()
  {
    return $this->belongsTo(Nacionalidad::class, "nacionalidad");
  }

  public function expedientes()
  {
    return $this->hasMany(Expediente::class, 'persona_id', 'id');
  }

  public function analisisRiesgos(): \Illuminate\Database\Eloquent\Relations\HasMany
  {
    return $this->hasMany(AnalisisRiesgo::class, 'persona_id');
  }

  public function expedienteCentroSesion()
  {
    $token = TokenService::get();
    $centro_id = $token["centro"];
    return $this->hasOne(Expediente::class, 'persona_id', 'id')
      ->where("centro_id", "=", $centro_id)->orderBy("id", "desc");
  }

  public function ubicacion()
  {
    return $this->hasOne(UbicacionReubicacion::class, 'persona_id', 'id')
      ->where("actual", "=", 1);
  }

  public function getUbicacionDescripcionAttribute()
  {
    return 'Módulo: ' . $this->ubicacion_modulo . ' Sección: ' . $this->ubicacion_seccion . ' Estancia: ' . $this->ubicacion_estancia . ' Dormitorio: ' . $this->ubicacion_dormitorio;
  }

  public function ubicacion2()
  {
    $token = TokenService::get();
    $centro_id = $token["centro"];
    return $this->hasOne(UbicacionReubicacion::class, 'persona_id', 'id')->orderBy("id", "desc");
  }

  public function procesos()
  {
    return $this->hasManyThrough(Proceso::class, Expediente::class, "expedientes.persona_id", "procesos.expediente_id", "id", "id");
  }

  public function procesosActivos()
  {
    return $this->hasManyThrough(Proceso::class, Expediente::class, "expedientes.persona_id", "procesos.expediente_id", "id", "id")
      ->activo();
  }

  public function evasiones()
  {
    return $this->hasManyThrough(Evasion::class, Expediente::class, "expedientes.persona_id", "evasiones.expediente_id", "id", "id");
  }

  public function evasionesActivas()
  {
    return $this->hasManyThrough(Evasion::class, Expediente::class, "expedientes.persona_id", "evasiones.expediente_id", "id", "id")
      ->activa();
  }

  public function alias()
  {
    return $this->hasMany(PersonaAlias::class, 'persona_id', 'id');
  }

  public function curps()
  {
    return $this->hasMany(PersonaCurp::class, 'persona_id', 'id');
  }

  public function padres()
  {
    return $this->hasMany(PersonaPadre::class, 'persona_id', 'id');
  }

  public function fotos()
  {
    return $this->hasOne(PersonaFotos::class, 'persona_id', 'id');
  }

  public function discapacidades()
  {
    return $this->hasMany(PersonaDiscapacidad::class, 'persona_id', 'id');
  }

  public function familiares()
  {
    return $this->hasManyThrough(Referencia::class, VisitaFamiliar::class, 'persona_id', 'id', 'id', 'referencia_id');
  }

  public function referencias()
  {
    return $this->hasManyThrough(Referencia::class, PersonaReferencia::class, 'persona_id', 'id', 'id', 'referencia_id');
  }

  public function estadoCivil()
  {
    return $this->flex();
  }

  public function identidadGenero()
  {
    return $this->flex();
  }

  public function lenguaIndigena()
  {
    return $this->flex();
  }

  public function paisNacimiento()
  {
    return $this->flex();
  }

  public function entidadNacimiento()
  {
    return $this->flex();
  }

  public function otrosNombres()
  {
    return $this->hasMany(PersonaOtroNombre::class, 'persona_id', 'id');
  }

  public function domicilios()
  {
    return $this->hasMany(PersonaDomicilio::class, 'persona_id', 'id');
  }

  // TODO  quitar, solo dejar la de seniaBiometrico
  public function seniaMediaFiliacion()
  {
    return $this->hasOne(SeniaMediaFiliacion::class);
  }

  public function seniaAntropometrico()
  {
    return $this->hasOne(SeniaAntropometrico::class);
  }

  public function seniasParticulares()
  {
    return $this->hasMany(SeniaParticular::class);
  }

  public function seniaHuellas()
  {
    return $this->hasOne(SeniaHuella::class);
  }

  public function seniaHuella()
  {
    return $this->hasOne(\App\Models\Ingresos\SeniaHuella::class);
  }

  public function seniaHuellasRodadas()
  {
    return $this->hasOne(SeniaHuellaRodada::class);
  }

  public function seniaIris()
  {
    return $this->hasOne(SeniaIris::class);
  }

  public function entrevistaLaboral()
  {
    return $this->hasOne(EntrevistaLaboral::class, "persona_id", "id");
  }

  public function senia_biometrico()
  {
    return $this->hasOne(SeniaBiometrico::class);
  }

  public function estado_civil()
  {
    return $this->flex();
  }

  public function identidad_genero()
  {
    return $this->flex();
  }

  public function lengua_indigena()
  {
    return $this->flex();
  }

  public function pais_nacimiento()
  {
    return $this->flex();
  }

  public function entidad_nacimiento()
  {
    return $this->flex();
  }

  public function expediente()
  {
    return $this->hasMany(Expediente::class, 'persona_id', 'id')->orderBy('updated_at', 'desc');
  }

  public function ultimo_expediente()
  {
    return $this->belongsTo(Expediente::class, 'ultimo_expediente', 'id');
  }

  public function otros_nombres()
  {
    return $this->hasMany(PersonaOtroNombre::class, 'persona_id', 'id');
  }

  public function domicilio()
  {
    return $this->hasMany(PersonaDomicilio::class, 'persona_id', 'id');
  }

  public function senia_media_filiacion()
  {
    return $this->hasOne(SeniaMediaFiliacion::class);
  }

  public function senia_antropometrico()
  {
    return $this->hasOne(SeniaAntropometrico::class);
  }

  public function senias_particulares()
  {
    return $this->hasMany(SeniaParticular::class);
  }

  public function senia_huellas()
  {
    return $this->hasOne(SeniaHuella::class);
  }

  public function senia_huellas_rodadas()
  {
    return $this->hasOne(SeniaHuellaRodada::class);
  }

  public function senia_iris()
  {
    return $this->hasOne(SeniaIris::class);
  }

  public function paisNacimientoObj()
  {
    return $this->belongsTo(Pais::class, "pais_nacimiento", "id");
  }

  public function entidadNacimientoObj()
  {
    return $this->belongsTo(Sepomex::class, "entidad_nacimiento", "c_estado");
  }

  public function municipioNacimientoObj()
  {
    return $this->belongsTo(Sepomex::class, "municipio_nacimiento", "c_mnpio")
      ->where("c_estado", "=", $this->entidad_nacimiento)->take(1);
  }


  public function escolaridadObj()
  {
    return $this->belongsTo(Escolaridad::class, "escolaridad", "id");
  }

  public function ocupacionObj()
  {
    return $this->belongsTo(Ocupacion::class, "ocupacion", "id");
  }

  public function ocupacionesMatch()
  {
    $ocupaciones = [];

    if ($this->ocupacion) {
      $flag = is_array(json_decode($this->ocupacion));
      if ($flag) {
        foreach (json_decode($this->ocupacion) as $ocup) {
          $flex = FlexfieldValue::where("id", $ocup)->first();
          $ocupaciones[] = $flex->description;
        }
      } else {
        $flex = FlexfieldValue::where("id", $this->ocupacion)->first();
        $ocupaciones[] = $flex->description;
      }
    }

    return $ocupaciones;
  }

  public function estadoCivilObj()
  {
    return $this->belongsTo(EstadoCivil::class, "estado_civil", "id");
  }

  public function religionObj()
  {
    return $this->belongsTo(Religion::class, "religion", "id");
  }

  public function etniaObj()
  {
    return $this->belongsTo(Etnia::class, "etnia", "id");
  }

  public function ultimoDomicilio()
  {
    return $this->hasOne(PersonaDomicilio::class, "persona_id")->orderBy("id", "desc");
  }

  public function scopePersona($query, $id)
  {
    return $query->where('id', $id);
  }

  public function getPhotoAttribute()
  {
    $seniaBiometrico = $this->senia_biometrico()->first();
    if ($seniaBiometrico && !empty($seniaBiometrico->ruta_a)) {
      return $seniaBiometrico->ruta_a;
    }
    return 'assets/images/users/avatar-1.jpg';
  }

  public function getNombreCompletoAttribute()
  {
    return $this->nombre . ' ' . $this->primer_apellido . ' ' . $this->segundo_apellido;
  }

  public function getSexoTxtAttribute()
  {
    return $this->sexo == "M" ? "Masculino" : ($this->sexo == "F" ? "Femenino" : "");
  }

  public function getAliasTxtAttribute()
  {
    $alias_array = [];

    foreach ($this->alias as $alias) {
      $alias_array[] = $alias->alias;
    }
    return implode(", ", $alias_array);
  }

  public function getOtrosNombresTxtAttribute()
  {
    $otros_nombres_array = [];

    foreach ($this->otrosNombres as $otros_nombres) {
      $otro = $otros_nombres->nombre . " " . $otros_nombres->primer_apellido;
      if ($otros_nombres->segundo_apellido) {
        $otro .= " " . $otros_nombres->segundo_apellido;
      }
      $otros_nombres_array[] = $otro;
    }
    return implode(", ", $otros_nombres_array);
  }

  public function getRutaImagenFrenteAttribute()
  {
    if ($this->seniaRostro) {
      try {
        fopen($this->dir() . $this->seniaRostro->ruta_a, 'r');
        return $this->dir() . $this->seniaRostro->ruta_a;
      } catch (\Exception $e) {
        return public_path('/img/avatar-1.png');
      }
    } else {
      return public_path('/img/avatar-1.png');
    }
  }

  public function getDiasNacimientoAttribute()
  {
    $date = new DateTime($this->fecha_nacimiento);
    $date->setTimezone(new DateTimeZone('America/Mexico_City'));
    return $date->format('d');
  }

  public function getMesNacimientoAttribute()
  {
    $date = new DateTime($this->fecha_nacimiento);
    $date->setTimezone(new DateTimeZone('America/Mexico_City'));
    return $date->format('m');
  }

  public function getAnioNacimientoAttribute()
  {
    $date = new DateTime($this->fecha_nacimiento);
    $date->setTimezone(new DateTimeZone('America/Mexico_City'));
    return $date->format('Y');
  }

  public function getLugarNacimientoAttribute()
  {
    if ($this->municipioNacimientoObj) {
      $lugar_nacimiento[] = $this->municipioNacimientoObj?->D_mnpio;
    }
    if ($this->entidadNacimientoObj) {
      $lugar_nacimiento[] = $this->entidadNacimientoObj?->d_estado;
    }
    $lugar_nacimiento[] = ucfirst(mb_strtolower($this->paisNacimientoObj->description));


    return implode(", ", $lugar_nacimiento);
  }

  public function getFechaNacimientoFormatAttribute()
  {
    $date = new DateTime($this->fecha_nacimiento);
    $date->setTimezone(new DateTimeZone('America/Mexico_City'));
    return $date->format('d/m/Y');
  }

  public function getFechaIngresoAttribute()
  {
    $expediente = $this->expedienteCentroSesion;
    if ($expediente) {
      return $expediente->ultima_fecha_ingreso;
    }
    return "- - -";
  }

  public function getHoraIngresoAttribute()
  {
    $expediente = $this->expedienteCentroSesion;
    if ($expediente) {
      return $expediente->ultima_hora_ingreso;
    }
    return "- - -";
  }

  public function getNumeroExpedienteAttribute()
  {
    $expediente = $this->expedienteCentroSesion;
    if ($expediente) {
      return $expediente->num_expediente;
    }
    return "- - -";
  }

  public function getUbicacionModuloAttribute()
  {
    $ubicacion = $this->ubicacion;

    if ($ubicacion instanceof UbicacionReubicacion && $ubicacion->modulo) {
      return str_replace(["modulo", "MÓDULO"], "", $ubicacion->modulo->nombre);
    }
    return "- - -";
  }

  public function getUbicacionSeccionAttribute()
  {
    $ubicacion = $this->ubicacion;

    if ($ubicacion instanceof UbicacionReubicacion && $ubicacion->seccion) {
      return $ubicacion->seccion->nombre;
    }
    return "- - -";
  }

  public function getUbicacionEstanciaAttribute()
  {
    $ubicacion = $this->ubicacion;

    if ($ubicacion instanceof UbicacionReubicacion && $ubicacion->estancia) {
      return $ubicacion->estancia->nombre;
    }
    return "- - -";
  }

  public function getUbicacionDormitorioAttribute()
  {
    $ubicacion = $this->ubicacion;

    if ($ubicacion instanceof UbicacionReubicacion && $ubicacion->dormitorio) {
      return str_replace(["dormitorio", "DORMITORIO"], "", $ubicacion->dormitorio->nombre);
    }
    return "- - -";
  }

  public function getUbicacionCamaAttribute()
  {
    $ubicacion = $this->ubicacion;

    if ($ubicacion instanceof UbicacionReubicacion && $ubicacion->cama) {
      return $ubicacion->cama->nombre;
    }
    return "- - -";
  }

  public function getDomicilioActualAttribute()
  {
    $domicilio_txt = "";
    $domicilio = $this->ultimoDomicilio;
    if ($domicilio) {
      $domicilio_txt = $domicilio->calle . " # " . $domicilio->numero_ext;
      if ($domicilio->numero_int) {
        $domicilio_txt .= ", interior " . $domicilio->numero_int;
      }

      if ($domicilio->entre_calle) {
        $domicilio_txt .= ", entre calle " . $domicilio->entre_calle;
      }
      if ($domicilio->y_calle) {
        $domicilio_txt .= ", y calle " . $domicilio->y_calle;
      }

      if ($domicilio->colonia) {
        $domicilio_txt .= ", Col. " . $domicilio->colonia;
      }

      if ($domicilio->asenta) {
        $domicilio_txt .= ", " . $domicilio->asenta->d_tipo_asenta . "  " . $domicilio->asenta->d_asenta;
      }

      if ($domicilio->cp) {
        $domicilio_txt .= ", C.P. " . $domicilio->cp;
      }

      if ($domicilio->asenta) {
        $domicilio_txt .= ", País: México";
        $domicilio_txt .= ", Estado: " . $domicilio->asenta->d_estado;
        $domicilio_txt .= ", Municipio: " . $domicilio->asenta->D_mnpio;
      }

      if ($domicilio->observaciones) {
        $domicilio_txt .= ", Observaciones: " . $domicilio->observaciones;
      }

      if ($domicilio->telefono) {
        $domicilio_txt .= ", Tel.: " . $domicilio->lada . " " . $domicilio->telefono;
      }

      return $domicilio_txt;
    }
    return "- - -";
  }

  public function getTieneCicatricesAttribute()
  {
    if ($this->seniasParticulares()->where('tipo_senia', '=', 1)->exists()) {
      return "Sí";
    }
    return "No";
  }

  public function getTieneTatuajesAttribute()
  {
    if ($this->seniasParticulares()->where('tipo_senia', '=', 2)->exists()) {
      return "Sí";
    }
    return "No";
  }

  public function getTieneLunaresAttribute()
  {
    if ($this->seniasParticulares()->where('tipo_senia', '=', 3)->exists()) {
      return "Sí";
    }
    return "No";
  }

  public function getTieneDefectosAttribute()
  {
    if ($this->seniasParticulares()->where('tipo_senia', '=', 4)->exists()) {
      return "Sí";
    }
    return "No";
  }

  public function getTieneProtesisAttribute()
  {
    if ($this->seniasParticulares()->where('tipo_senia', '=', 5)->exists()) {
      return "Sí";
    }
    return "No";
  }

  public function getTieneModificacionesAttribute()
  {
    if ($this->seniasParticulares()->where('tipo_senia', '=', 6)->exists()) {
      return "Sí";
    }
    return "No";
  }

  public function getMediaFiliacionArrayAttribute()
  {
    $ids = [
      10 => "complexion",
      11 => "color_piel",
      12 => "cara",
      13 => "cabello_cantidad",
      14 => "cabello_color",
      15 => "cabello_forma",
      16 => "calvicie",
      17 => "implantacion",
      18 => "altura_frente",
      19 => "inclinacion_frente",
      20 => "ancho_frente",
      21 => "direccion_cejas",
      22 => "implantacion_cejas",
      23 => "forma_cejas",
      24 => "tamanio_cejas",
      25 => "color_ojos",
      26 => "forma_ojos",
      27 => "tamanio_ojos",
      28 => "nariz_raiz",
      29 => "nariz_dorso",
      30 => "nariz_ancho",
      31 => "nariz_base",
      32 => "nariz_altura",
      33 => "boca_tamanio",
      34 => "boca_comisuras",
      35 => "boca_espesor",
      36 => "boca",
      37 => "boca_prominencia",
      38 => "menton_tipo",
      39 => "menton_forma",
      40 => "menton_inclinacion",
      41 => "oreja_d_forma",
      42 => "oreja_d_trago",
      43 => "oreja_d_antitrago",
      44 => "oreja_d_helix_adherencia",
      45 => "oreja_d_helix_original",
      46 => "oreja_d_helix_posterior",
      47 => "oreja_d_helix_superior",
      48 => "oreja_d_lobulo_contorno",
      49 => "oreja_d_lobulo_adherencia",
      50 => "oreja_d_lobulo_dimension",
      51 => "oreja_d_lobulo_particularidad",
      52 => "tipo_sangre",
      53 => "factor_rh"
    ];

    $arreglo_media_filiacion = [];
    foreach ($ids as $id => $campo) {
      $ff = Flexfield::find($id);
      $ffv = FlexfieldValue::find($this->seniaMediaFiliacion?->$campo);
      $arreglo_media_filiacion[] = ["label" => $ff->name, "value" => $ffv?->description];
    }
    return $arreglo_media_filiacion;
  }

  public function getEdadAttribute()
  {
    $date = new DateTime($this->fecha_nacimiento);
    $date->setTimezone(new DateTimeZone('America/Mexico_City'));
    return $date->diff(new DateTime())->y;
  }

  /**
   *Otros Métodos
   */

  private function dir()
  {
    return storage_path('app/public') . "/persona/" . $this->hash_dir . "/";
  }

  public function fotografias()
  {
    return $this->hasMany(Fotografia::class);
  }

  public function ultimo_centro()
  {
    return $this->hasOne(Centro::class, "id", "ultimo_centro");
  }

  public function incidencias()
  {
    return $this->hasManyThrough(Incidente::class, IncidenteInvolucrado::class, 'persona_id', 'id', 'id', 'incidente_id');
  }
}
