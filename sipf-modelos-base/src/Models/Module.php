<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
  protected $table = 'modules';

  public function groupedPermission()
  {
    return $this->hasMany(GroupedPermission::class, 'module_id', 'id');
  }
}
