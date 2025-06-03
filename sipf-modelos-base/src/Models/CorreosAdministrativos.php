<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class CorreosAdministrativos extends FFV
{
  use HasFactory, SoftDeletes;

  protected $table = 'correos_administrativos';

  protected $fillable = [
    'correo',
    'centro_id',
    'user_id',
    'tag',
  ];

  public $rules = [
    'correo' => 'required',
  ];
}
