<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Flexfield extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['id', 'name', 'description', 'code', 'aux_1', 'aux_2', 'ff_parent_id'];

    public function values()
    {
        return $this->hasMany(FlexfieldValue::class);
    }

    public function subflexfield()
    {
        return $this->hasOne(Flexfield::class, 'ff_parent_id', 'id');
    }

    public function supflexfield()
    {
        return $this->hasOne(Flexfield::class, 'id', 'ff_parent_id');
    }


    public function tables()
    {
        return $this->hasMany(FlexfieldTable::class);
    }

    public function ffv()
    {
        return $this->hasOne(FlexfieldValue::class);
    }

    public function scopeCode($query, $code)
    {
        return $query->where('code', $code);
    }

    public function customRelation()
    {
        return $this->hasMany(FlexfieldValue::class, "flexfield_id", "code");
    }

    static function getValuesByCode($code)
    {
        return Flexfield::code($code)->first()->values();
    }
}
