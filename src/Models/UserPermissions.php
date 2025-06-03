<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPermissions extends Model
{
    use HasFactory;

    protected $table = 'users_permissions';
    protected $fillable = ['id', 'user_id', 'permission_id', 'assignment_type'];
}
