<?php

namespace Sipf\ModelosBase\Models;

use Spatie\Permission\Models\Role as SpatieRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends SpatieRole
{
  use HasFactory;

  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'roles';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'id',
    'name',
    'guard_name',
    'created_at',
    'updated_at',
  ];

  /**
   * Función que retorna los usuarios que tienen asignado el rol
   * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
   */
  public function users(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
  {
    return $this->belongsToMany(User::class, 'user_roles', 'role_id', 'user_id');
  }

  /**
   * Función que retorna los permisos que tiene asignado el rol
   * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
   */
  public function permissions(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
  {
    return $this->belongsToMany(Permission::class, 'role_has_permissions', 'role_id', 'permission_id');
  }
}
