<?php

namespace Sipf\ModelosBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    use HasFactory;

    public $table = 'user_info';

    protected $fillable = [
        'id',
        'name',
        'last_name',
        'photo',
        'tel_mobile',
        'tel_office',
        'tel_home',
        'address',
        'birthday',
        'gender',
        'about'
    ];

    public $rules = [
        'id' => 'required|integer',
        'name' => 'string|max:6255',
        'last_name' => 'string|max:255',
        'tel_mobile' => 'string|max:15',
        'tel_office' => 'string|max:15',
        'tel_home' => 'string|max:15',
        'address' => 'string',
        'birthday' => 'date',
        'gender' => 'integer:unsigned',
        'about' => 'string'
    ];
}
