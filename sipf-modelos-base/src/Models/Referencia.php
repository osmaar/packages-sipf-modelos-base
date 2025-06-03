<?php

namespace Sipf\ModelosBase\Models;

use App\Models\Traits\Searchable;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Sipf\ModelosBase\Models\CatalogosFlexFields\Escolaridad;
use Sipf\ModelosBase\Models\CatalogosFlexFields\Estado;
use Sipf\ModelosBase\Models\CatalogosFlexFields\EstadoCivil;
use Sipf\ModelosBase\Models\CatalogosFlexFields\Ocupacion;
use Sipf\ModelosBase\Models\CatalogosFlexFields\Pais;
use Sipf\ModelosBase\Models\CatalogosFlexFields\TipoInstitucion;
use Sipf\ModelosBase\Models\CatalogosFlexFields\TipoPersona;
use Sipf\ModelosBase\Models\Tecnico\TrabajoSocial\Infantes\InfantePropuesta;

/**
 * Clase Familiar para obtener los datos de los familiares de la persona que es el ppl.
 */
class Referencia extends FFV
{
  use HasFactory, Searchable;

  public static $rules = [
    'id' => 'integer',
    'persona_id' => 'nullable|exists:personas,id',
    'tipo_registro' => 'integer',
    'nombre' => 'required|string|max:50',
    'primer_apellido' => 'required|string|max:50',
    'ocupacion' => 'integer',
    'lugar_trabajo' => 'string|max:50',
    'tipo_institucion' => 'integer',
    'institucion_otra' => 'string',
    'tipo_persona' => 'integer',
    'sexo' => 'in:F,M,X',
    'fecha_nacimiento' => 'date',
    'pais_nacimiento' => 'integer',
    'estado_nacimiento' => 'integer',
    'estado_civil' => 'integer',
    'finado' => 'in:Vive,Finado',
    'escolaridad' => 'integer',
    'tipo_registro_foto' => 'integer',
  ];
  public $camposBusqueda = ['nombre', 'primer_apellido', 'segundo_apellido', 'curp'];
  protected $table = 'referencias';
  protected $appends = [
    'ruta_foto',
    'nombre_completo'
  ];
  protected $fillable = [
    'id',
    'persona_id',
    'tipo_registro',
    'nombre',
    'primer_apellido',
    'segundo_apellido',
    'ocupacion',
    'lugar_trabajo',
    'puesto_ocupa',
    'tipo_institucion',
    'institucion_otra',
    'tipo_persona',
    'sexo',
    'curp',
    'fecha_nacimiento',
    'pais_nacimiento',
    'estado_nacimiento',
    'estado_civil',
    'finado',
    'extranjero',
    'pais',
    'direccion_exacta',
    'calle',
    'numero_exterior',
    'numero_interior',
    'codigo_postal',
    'colonia',
    'municipio',
    'estado',
    'telefono_fijo',
    'telefono_movil',
    'observaciones',
    'escolaridad',
    'adicciones',
    'antecedentes_penales',
    'pais_tel_fijo',
    'pais_tel_movil',
    'tipo_registro_foto',
    'estatus_persona',
    'colonia_text',
    'municipio_text',
    'estado_text',
    'correo',
    'enfermedad',
    'medicamento',
    'discapacidad',
    'aparatos',
    'fecha_nac_exacta',
    'primer_calle',
    'segunda_calle',
    'es_tutor'
  ];
  protected $dates = ['deleted_at'];

  public function getRutaFotoAttribute()
  {
    $seniaBiometricoFamiliar = $this->senia_biometrico_familiar()->first();
    if ($seniaBiometricoFamiliar && !empty($seniaBiometricoFamiliar->ruta_foto)) {
      return $seniaBiometricoFamiliar->ruta_foto;
    }
    return 'assets/images/users/avatar-1.jpg';
  }

  /**
   * obtén la relación con la tabla senia_huella_familiar que hace referencia al id de la tabla familiares para obtener los datos de las señas y huellas de los familiares del ppl.
   *
   * @return
   */
  public function senia_biometrico_familiar()
  {
    return $this->hasOne(SeniaBiometricoFamiliar::class, 'familiar_id', 'id');
  }

  /**
   * Obtiene el catalogo de registro a partir del campo que esta dentro de la tabla familiares parentesco ocupación del flexfield..
   *
   * @return void
   */
  public function tipo_registro()
  {
    return $this->flex();
  }

  /**
   * Obtiene el catalogo de ocupación a partir del campo que esta dentro de la tabla familiares ocupación del flexfield.
   *
   * @return void
   */
  public function ocupacion()
  {
    return $this->flex();
  }

  public function ocupacionObj()
  {
    return $this->belongsTo(Ocupacion::class, "ocupacion", "id");
  }

  public function personaReferencia()
  {
    return $this->hasOne(PersonaReferencia::class);
  }

  /**
   * Obtiene el catalogo de institución a partir del campo que esta dentro de la tabla familiares parentesco ocupación del flexfield..
   *
   * @return void
   */
  public function tipo_institucion()
  {
    return $this->flex();
  }

  public function tipoInstitucion()
  {
    return $this->belongsTo(TipoInstitucion::class, "tipo_institucion", "id");
  }

  /**
   * Obtiene el catalogo de tipo_persona a partir del campo que esta dentro de la tabla familiares parentesco ocupación del flexfield..
   *
   * @return void
   */
  public function tipo_persona()
  {
    return $this->flex();
  }

  public function tipoPersona()
  {
    return $this->belongsTo(TipoPersona::class, "tipo_persona", "id");
  }

  /**
   * Obtiene el catalogo de estado_civil a partir del campo que esta dentro de la tabla familiares estado_civil del flexfield.
   *
   * @return void
   */
  public function estado_civil()
  {
    return $this->flex();
  }

  public function estadoCivil()
  {
    return $this->belongsTo(EstadoCivil::class, "estado_civil", "id");
  }

  /**
   * Obtiene el catalogo de finado a partir del campo que esta dentro de la tabla familiares finado del flexfield.
   *
   * @return void
   */
  public function finado()
  {
    return $this->flex();
  }

  /**
   * Obtiene el catalogo de país a partir del campo que esta dentro de la tabla familiares país del flexfield.
   *
   * @return void
   */
  public function pais_nacimiento()
  {
    return $this->flex();
  }

  public function paisNacimiento()
  {
    return $this->belongsTo(Pais::class, "pais_nacimiento", "id");
  }

  /**
   * Obtiene el catalogo de colonia a partir del campo que esta dentro de la tabla familiares colonia del flexfield.
   *
   * @return void
   */
  public function colonia()
  {
    return $this->belongsTo(Sepomex::class, "codigo_postal", "d_codigo");
  }

  public function residencia()
  {
    return $this->belongsTo(Sepomex::class, "colonia", "id_asenta_cpcons")
      ->where("d_codigo", "=", $this->codigo_postal);
  }

  /**
   * Obtiene el catalogo de municipio a partir del campo que esta dentro de la tabla familiares municipio del flexfield.
   *
   * @return void
   */
  public function municipio()
  {
    return $this->flex();
  }

  public function estado()
  {
    return $this->belongsTo(SepomexEstado::class, "estado", "c_estado");
  }

  /**
   * Obtiene el catalogo de estado a partir del campo que esta dentro de la tabla familiares estado del flexfield.
   *
   * @return void
   */
  public function estado_nacimiento()
  {
    return $this->belongsTo(SepomexEstado::class, "estado_nacimiento", "c_estado");
  }

  public function estadoNacimiento()
  {
    return $this->belongsTo(Estado::class, "estado_nacimiento", "value");
  }

  public function pais()
  {
    return $this->flex();
  }

  public function paisResidencia()
  {
    return $this->belongsTo(Pais::class, "pais", "id");
  }

  public function pais_tel_fijo()
  {
    return $this->flex();
  }

  public function pais_tel_movil()
  {
    return $this->flex();
  }

  /**
   * Obtiene el catalogo de escolaridad a partir del campo que esta dentro de la tabla familiares escolaridad del flexfield.
   *
   * @return void
   */
  public function escolaridad()
  {
    return $this->flex();
  }

  public function escolaridadObj()
  {
    return $this->belongsTo(Escolaridad::class, "escolaridad", "id");
  }

  public function persona()
  {
    return $this->personas()->first();
  }

  public function personas()
  {
    return $this->belongsToMany(Persona::class, 'personas_referencias', 'referencia_id', 'persona_id', 'id', '');
  }

  public function scopeConPersona(Builder $query, $persona_id)
  {
    return $query->join(
      'personas_referencias as pr',
      'pr.referencia_id',
      '=',
      DB::raw('referencias.id and pr.persona_id=' . $persona_id)
    );
  }

  public function parentesco($persona)
  {
    return $this->parentescoRelacion()->where('persona_id', $persona);
  }

  public function getParentesco($ppl)
  {
    $join = $this->parentescoJoin($ppl)->first();
    return $join ? $join->description : "";
  }

  public function parentescoRelacion()
  {
    return $this->hasOneThrough(
      FlexfieldValue::class,
      PersonaReferencia::class,
      'referencia_id',
      'id',
      'id',
      'parentesco'
    );
  }

  public function parentescoJoin($persona)
  {
    return FlexfieldValue::join(
      'personas_referencias as pr',
      'flexfield_values.id',
      '=',
      DB::raw("pr.parentesco and pr.persona_id={$persona} and pr.referencia_id={$this->id}")
    );
  }

  /**
   * obtiene la relación del registro de foto
   *
   * @return void
   */
  public function tipo_registro_foto()
  {
    return $this->flex();
  }

  public function estatus_persona()
  {
    return $this->flex();
  }

  /**
   * obtén la relación con la tabla senia_huella_familiar que hace referencia al id de la tabla familiares para obtener los datos de las señas y huellas de los familiares del ppl.
   *
   * @return void
   */
  public function senia_huella_familiar()
  {
    return $this->hasMany(SeniaHuellaFamiliar::class);
  }

  //función para eliminar datos usando SoftDeletes.
  use SoftDeletes;

  public function propuesta_llamadas()
  {
    return $this->hasMany(PropuestaLlamadas::class, "id_persona_familiar", "id");
  }

  //datos que se pueden guardar en la tabla

  public function registro_llamadas()
  {
    return $this->hasMany(RegistroLlamadas::class, "id", "id_propuesta_nombre_persona");
  }

  //dato que se insertara en la tabla al eliminar con softDelete.

  public function correspondence()
  {
    return $this->hasMany(SendCorrespondence::class, "id", "id_familiar");
  }

  //reglas de validación de acuerdo a los campos de la tabla.

  public function remitente_id()
  {
    return $this->hasMany(RecepcionCorrespondencia::class, "id", "remitente_id");
  }

  public function visita_familiar()
  {
    return $this->hasMany(VisitaFamiliar::class, 'referencia_id');
  }

  public function visitasFamiliares()
  {
    return $this->hasMany(VisitaFamiliar::class, 'referencia_id');
  }

  public function visitasFamiliaresAutorizadas()
  {
    return $this->hasMany(VisitaFamiliar::class, 'referencia_id')->autorizada();
  }

  public function visitasExternas()
  {
    return $this->hasMany(VisitaExterna::class, 'referencia_id');
  }

  public function visitasExternasAutorizadas()
  {
    return $this->hasMany(VisitaExterna::class, 'referencia_id')->autorizada();
  }

  public function visita_externa()
  {
    return $this->hasMany(VisitaExterna::class, 'referencia_id');
  }

  public function visitas()
  {
    return $this->hasMany(VisitaAcceso::class, 'referencia_id');
  }

  public function propuestasEgreso()
  {
    return $this->hasMany(InfantePropuesta::class);
  }


  public function asenta()
  {
    return $this->belongsTo(Sepomex::class, "colonia", "id_asenta_cpcons")
      ->where("c_estado", "=", $this->estado)
      ->where("c_mnpio", "=", $this->municipio)
    ;
  }

  public function getNombreCompletoAttribute()
  {
    return $this->nombre . " " . $this->primer_apellido . " " . $this->segundo_apellido;
  }

  public function getFechaNacimientoFormatAttribute()
  {
    $date = date_create($this->fecha_nacimiento);
    return date_format($date, "d/m/Y");
  }

  public function getTelefonosAttribute()
  {
    $telefonos = [];
    if ($this->telefono_fijo) {
      $telefonos[] = $this->pais_tel_fijo . "-" . $this->telefono_fijo;
    }
    if ($this->telefono_movil) {
      $telefonos[] = $this->pais_tel_movil . "-" . $this->telefono_movil;
    }
    return implode(", ", $telefonos);
  }

  public function getDomicilioAttribute()
  {
    $domicilio_txt = "";

    if ($this->calle) {
      $domicilio_txt = $this->calle;
    }

    if ($this->numero_exterior) {
      $domicilio_txt .= " # " . $this->numero_exterior;
    }

    if ($this->numero_interior) {
      $domicilio_txt .= ", interior " . $this->numero_interior;
    }

    if ($this->direccion_exacta == "No") {
      if ($this->colonia_text) {
        $domicilio_txt .= ", Col.: " . $this->colonia_text;
      }
      if ($this->municipio_text) {
        $domicilio_txt .= ", Municipio: " . $this->municipio_text;
      }
      if ($this->estado_text) {
        $domicilio_txt .= ", Estado: " . $this->estado_text;
      }
    }

    if ($this->direccion_exacta == "Si") {
      if ($this->asenta) {
        $domicilio_txt .= ", " . $this->asenta->d_tipo_asenta . "  " . $this->asenta->d_asenta;
      }

      if ($this->asenta) {
        $domicilio_txt .= ", País: México";
        $domicilio_txt .= ", Estado: " . $this->asenta->d_estado;
        $domicilio_txt .= ", Municipio: " . $this->asenta->D_mnpio;
      }
    }

    if ($this->codigo_postal) {
      $domicilio_txt .= ", C.P. " . $this->codigo_postal;
    }

    if ($this->observaciones) {
      if ($domicilio_txt == "") {
        $domicilio_txt .= "Observaciones: " . $this->observaciones;
      } else {
        $domicilio_txt .= ", Observaciones: " . $this->observaciones;
      }
    }

    return $domicilio_txt;
  }

  public function tutor()
  {
    return $this->hasOne(Referencia::class, 'es_tutor', 'id')->with('personaReferencia');
  }

  public function getEstadoAttribute($value)
  {
    return (int) $value;
  }
}
