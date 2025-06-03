<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FlexfieldTable extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['id', 'flexfield_id', 'table_name', 'field_name'];

    public function flexfield()
    {
        return $this->belongsTo(Flexfield::class);
    }
}
