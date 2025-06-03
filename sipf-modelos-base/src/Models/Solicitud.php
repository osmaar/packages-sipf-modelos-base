<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Solicitud extends Model
{
    use SoftDeletes;

    protected $table = 'solicitudes';
    protected $fillable = ['id', 'user_id', 'movimiento_id', 'documento_solicitud', 'documento_resolucion'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function movimiento()
    {
        return $this->belongsTo(MovimientoSolicitud::class);
    }

    public function bitacoras()
    {
        return $this->hasMany(BitacoraSolicitud::class, 'solicitud_id');
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function scopeFilter($query, $filter)
    {
        $query->when($filter ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                if (preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $search)) {
                    // Formato dd/mm/aaaa
                    $searchDate = \DateTime::createFromFormat('d/m/Y', $search);
                    $searchYear = $searchDate->format('Y');
                    $searchMonth = $searchDate->format('m');
                    $searchDay = $searchDate->format('d');

                    // Filtrar por fecha completa
                    $query->whereYear('solicitudes.created_at', $searchYear)
                        ->whereMonth('solicitudes.created_at', $searchMonth)
                        ->whereDay('solicitudes.created_at', $searchDay);
                } elseif (preg_match('/^\d{2}\/\d{2}$/', $search)) {
                    $searchDateParts = explode('/', $search);
                    $searchDay = $searchDateParts[0];
                    $searchMonth = $searchDateParts[1];

                    // Filtrar por día y mes
                    $query->whereRaw('DATE_FORMAT(solicitudes.created_at, "%d-%m") LIKE ?', [$searchDay . '-' . $searchMonth]);
                } else {
                    $query->where('solicitudes.id', 'like', '%' . $search . '%')
                        ->orWhereHas('user', function ($q) use ($search) {
                            $q->where('nombre', 'like', '%' . $search . '%')
                                ->orWhere('ap1', 'like', '%' . $search . '%')
                                ->orWhere('ap2', 'like', '%' . $search . '%')
                                ->orWhere('c_empleado', 'like', '%' . $search . '%')
                                ->orWhereRaw("(
                                    case
                                        when centro_id = 1 then 'CEFERESO No. 1'
                                        when centro_id = 2 then 'CEFERESO No. 4'
                                        when centro_id = 3 then 'CEFERESO No. 5'
                                        when centro_id = 4 then 'CEFERESO No. 7'
                                        when centro_id = 5 then 'CEFERESO No. 8'
                                        when centro_id = 6 then 'CEFERESO No. 11'
                                        when centro_id = 7 then 'CEFERESO No. 12'
                                        when centro_id = 8 then 'CEFERESO No. 13'
                                        when centro_id = 9 then 'CEFERESO No. 14'
                                        when centro_id = 10 then 'CEFERESO No. 15'
                                        when centro_id = 11 then 'CEFERESO No. 16'
                                        when centro_id = 12 then 'CEFERESO No. 17'
                                        when centro_id = 13 then 'CEFERESO No. 18'
                                        when centro_id = 14 then 'CEFEREPSI'
                                    end
                                ) like ?", ["%$search%"]);
                        })
                        ->orWhereHas('user.rolesUser', function ($q) use ($search) {
                            $q->where('name', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('movimiento', function ($q) use ($search) {
                            $q->where('name', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('bitacoras', function ($q) use ($search) {
                            $q->where('estatus', 'like', '%' . $search . '%')->where('activo', 1);
                        })
                        ->orWhereDate('solicitudes.created_at', 'like', '%' . $search . '%');
                }
            });
        });
    }

    public function scopeFilter2($query, $data)
    {
        $searchFields = ['solicitud_id', 'clave_empleado', 'nombre', 'rol', 'tipo_movimiento', 'estatus', 'centro'];

        foreach ($searchFields as $field) {
            if (isset($data[$field])) {
                $search = $data[$field];
                if ($field == 'solicitud_id') {
                    $query->where('solicitudes.id', 'LIKE', '%' . $search . '%');
                } elseif ($field == 'clave_empleado') {
                    $query->whereHas('user', function ($q) use ($search) {
                        $q->where('c_empleado', 'LIKE', '%' . $search . '%');
                    });
                } elseif ($field == 'nombre') {
                    $query->whereHas('user', function ($q) use ($search) {
                        $q->where('nombre', 'LIKE', '%' . $search . '%')
                            ->orWhere('ap1', 'LIKE', '%' . $search . '%')
                            ->orWhere('ap2', 'LIKE', '%' . $search . '%');
                    });
                } elseif ($field == 'rol') {
                    $query->whereHas('user.rolesUser', function ($q) use ($search) {
                        $q->where('name', 'LIKE', '%' . $search . '%');
                    });
                } elseif ($field == 'tipo_movimiento') {
                    $query->whereHas('movimiento', function ($q) use ($search) {
                        $q->where('name', 'LIKE', '%' . $search . '%');
                    });
                } elseif ($field == 'estatus') {
                    $query->whereHas('bitacoras', function ($q) use ($search) {
                        $q->where('estatus', 'LIKE', '%' . $search . '%')->where('activo', 1);
                    });
                } elseif ($field == 'centro') {
                    $query->whereHas('user', function ($q) use ($search) {
                        $q->whereRaw("(
                            case
                                when centro_id = 1 then 'CEFERESO No. 1'
                                when centro_id = 2 then 'CEFERESO No. 4'
                                when centro_id = 3 then 'CEFERESO No. 5'
                                when centro_id = 4 then 'CEFERESO No. 7'
                                when centro_id = 5 then 'CEFERESO No. 8'
                                when centro_id = 6 then 'CEFERESO No. 11'
                                when centro_id = 7 then 'CEFERESO No. 12'
                                when centro_id = 8 then 'CEFERESO No. 13'
                                when centro_id = 9 then 'CEFERESO No. 14'
                                when centro_id = 10 then 'CEFERESO No. 15'
                                when centro_id = 11 then 'CEFERESO No. 16'
                                when centro_id = 12 then 'CEFERESO No. 17'
                                when centro_id = 13 then 'CEFERESO No. 18'
                                when centro_id = 14 then 'CEFEREPSI'
                            end
                        ) like ?", ["%$search%"]);
                    });
                }
            }
        }
    }
}
