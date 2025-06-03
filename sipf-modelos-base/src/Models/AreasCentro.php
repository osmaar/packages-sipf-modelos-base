<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AreasCentro extends Model
{
  use HasFactory;

  /**
   * Summary of table
   * @var string
   */
  protected $table = 'areas_centro';

  /**
   * Summary of fillable
   * @var array
   */
  protected $fillable = [
    'id',
    'no_area',
    'name',
    'created_at',
    'updated_at'
  ];
}
