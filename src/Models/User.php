<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\DB;
use Sipf\ModelosBase\Models\Tecnico\Seguridad\PaseDeLista\Turno;
use Spatie\Permission\Models\Role;

/**
 * Modelo de usuario.
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 *
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;
    use HasRoles;

    /**
     * Los atributos que son asignables en la tabla.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'nombre',
        'ap1',
        'ap2',
        'area',
        'puesto',
        'centro_id',
        'estado_id',
        'account_id',
        'c_empleado',
        'first_pass',
        'token',
        'token_usado',
        'activo',
        'email_envio',
        'last_ip_address',
        'last_login_from',
        'tipo',
    ];

    public $rules = [
        'id' => 'required|integer',
        'name' => 'required|string|max:255',
    ];

    /**
     * Los atributos que deben estar ocultos para la serialización.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'recovery_email',
    ];

    /**
     * Los atributos que deben ser elegidos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function last_access()
    {
        return $this->hasMany(UserLastAccess::class, 'id');
    }

    public function info()
    {
        return $this->hasOne(UserInfo::class, 'id');
    }

    public function rolesUser()
    {
        return $this->belongsToMany(Rol::class, 'user_roles', 'user_id', 'role_id');
    }

    public function centro()
    {
        return $this->belongsTo(Centro::class, 'centro_id');
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return int|string
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Get the custom claims that will be stored in the JWT.
     *
     * @return array<string, mixed>
     */
    public function getJWTCustomClaims(): array
    {
        return [];
    }


    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles', 'user_id', 'role_id');
    }

    public function scopeFilter($query, $filter)
    {
        $query->when($filter ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('users.nombre', 'like', '%' . $search . '%')
                    ->orWhere('users.ap1', 'like', '%' . $search . '%')
                    ->orWhere('users.ap2', 'like', '%' . $search . '%')
                    ->orWhere('users.c_empleado', 'like', '%' . $search . '%')
                    ->orWhere('users.area', 'like', '%' . $search . '%')
                    ->orWhere('users.puesto', 'like', '%' . $search . '%')
                    ->orWhere('centros.nombre_centro', 'like', '%' . $search . '%');
            });
        });
    }

    public function scopeFilter2($query, $data)
    {
        $searchFields = ['c_empleado', 'nombre_centro', 'area', 'nombre', 'puesto'];

        foreach ($searchFields as $field) {
            if (isset($data[$field])) {
                if ($field == 'nombre_centro') {
                    $query->where('centros.nombre_centro', 'LIKE', '%' . $data[$field] . '%');
                } elseif ($field == 'nombre') {
                    $query->where('nombre', 'LIKE', '%' . $data[$field] . '%')
                        ->orWhere('ap1', 'LIKE', '%' . $data[$field] . '%')
                        ->orWhere('ap2', 'LIKE', '%' . $data[$field] . '%');
                } else {
                    $query->where($field, 'LIKE', '%' . $data[$field] . '%');
                }
            }
        }
    }

    public function getNameAttribute()
    {
        return $this->nombre . ' ' . $this->ap1 . ' ' . $this->ap2;
    }

    public function solicitudes()
    {
        return $this->hasMany(Solicitud::class);
    }

    public function turnos()
    {
        return $this->belongsToMany(Turno::class, 'turnos_usuarios', 'user_id', 'turno_id');
    }

    public function getMaxLevel()
    {
        return DB::table('user_roles')
            ->join('roles', 'user_roles.role_id', '=', 'roles.id')
            ->where('user_roles.user_id', $this->id)
            ->max('roles.level') ?? 3;
    }
}
