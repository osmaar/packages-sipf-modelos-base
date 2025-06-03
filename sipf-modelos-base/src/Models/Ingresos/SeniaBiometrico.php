<?php

namespace App\Models\Ingresos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SeniaBiometrico extends Model
{
    use HasFactory;

    protected $table = 'senias_biometricos';

    protected $fillable = ['persona_id'];
}
