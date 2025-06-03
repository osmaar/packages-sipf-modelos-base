<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FlexfieldValue extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['id', 'flexfield_id', 'value', 'description', 'aux_1', 'aux_2', 'ffv_parent_id'];

    public function flexfield()
    {
        return $this->belongsTo(Flexfield::class);
    }

    public function subvalues()
    {
        return $this->hasMany(FlexfieldValue::class, 'ffv_parent_id', 'id');
    }

    public function parentValue()
    {
        return $this->belongsTo(FlexfieldValue::class, 'ffv_parent_id', 'id');
    }

    public function scopeCode($query, $code)
    {
        return $query->where('flexfield_id', Flexfield::code($code)->first()->id);
    }

    public function customRelation()
    {
        // Personaliza aquí la lógica de carga
        return $this->hasMany(Flexfield::class, "flexfield_id", "code");
    }

    public function scopeVal($query, $value)
    {
        return $query->where('value', $value);
    }

    public function scopeId($query, $id)
    {
        return $query->where('id', $id);
    }
}
