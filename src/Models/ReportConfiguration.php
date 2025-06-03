<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportConfiguration extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'subject',
        'addresses',
        'status'
    ];

    public function getAddressesAttribute($value)
    {
        return explode(',', $value);
    }

    public function setAddressesAttribute($value)
    {
        $this->attributes['addresses'] = implode(',', $value);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'A');
    }

    public function scopeInactive($query)
    {
        return $query->where('status', 'I');
    }
}
