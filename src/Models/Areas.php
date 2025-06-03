<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Model;

class Areas extends Model
{
    protected $table = 'areas_centro';
    protected $fillable = ['id', 'no_area', 'name'];
}
