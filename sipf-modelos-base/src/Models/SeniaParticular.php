<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class SeniaParticular extends FFV
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'senias_particulares';

    protected $fillable = [
        'lado_topografia_humana',
        'region_topografia_humana',
        'tipo_senia',
        'senia_vista',
        'descripcion',
    ];

    public $rules = [
        'lado_topografia_humana|integer' => 'required|string|max:1',
        'region_topografia_humana' => 'required|integer',
        'tipo_senia' => 'required|integer',
        'senia_vista' => 'required|integer',
        'descripcion' => 'string|max:500',
    ];


    public function imagen_topografia_humana()
    {
        return $this->flex();
    }

    public function lado_topografia_humana()
    {
        return $this->flex();
    }

    public function region_topografia_humana()
    {
        return $this->hasMany(FlexfieldValue::class, "value", "region_topografia_humana", "id", "id");
    }

    public function tipo_senia()
    {
        return $this->hasMany(FlexfieldValue::class, "value", "tipo_senia", "id", "id");
    }

    public function tipo_senia_flex()
    {
        return $this->hasOne(FlexfieldValue::class, 'value', 'tipo_senia')
            ->where('flexfield_id', 58);
    }

    public function region_topografia_humana_flex()
    {
        return $this->hasOne(FlexfieldValue::class, "value", "region_topografia_humana")
            ->where('flexfield_id', 57);
    }


    public function senia_vista()
    {
        return $this->flex();
    }

    public function senia_clasificacion()
    {
        return $this->flex();
    }

    public function expediente()
    {
        return $this->belongsTo(Expediente::class);
    }

    public function persona()
    {
        return $this->belongsTo(Persona::class, "persona_id", "id");
    }
}
