<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolPermissions extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'role_has_permissions';

    protected $fillable = [
        "permission_id",
        "role_id"
    ];
}
