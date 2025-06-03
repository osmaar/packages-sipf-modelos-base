<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CatPais extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'cat_paises';
}
