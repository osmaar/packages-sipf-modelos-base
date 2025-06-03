<?php

namespace Sipf\ModelosBase\Models;

use App\Builders\FFVBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FFV extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function newEloquentBuilder($query)
    {
        return new FFVBuilder($query);
    }

    protected function flex()
    {
        $trace = debug_backtrace();
        return $this->hasOne(FlexfieldValue::class, 'id', $trace[1]['function'])
            ->select(['id', 'value', 'description']);
    }
}
