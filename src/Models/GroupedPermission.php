<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupedPermission extends Model
{
  use HasFactory;

  protected $table = 'grouped_permissions';

  protected $fillable = [
    'name',
    'description',
    'module_id',
    'active'
  ];

  public function options()
  {
    return $this->hasMany(Permission::class, 'group_id', 'id');
  }

  public function module()
  {
    return $this->belongsTo(Module::class, 'module_id');
  }
}
