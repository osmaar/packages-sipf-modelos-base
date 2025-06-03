<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
  use HasFactory;

  protected $table = 'permissions';
  protected $fillable = ['id', 'name', 'action', 'group_id', 'action', 'guard_name', 'visible_to_level'];

  public function roles()
  {
    return $this->belongsToMany(Role::class, 'role_has_permissions', 'permission_id', 'role_id');
  }
}
