<?php

namespace App\Models;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaseModelDates extends Model
{
    use HasFactory;

    public function setCreatedAtAttribute($value)
    {
        $this->attributes['created_at'] = Carbon::now('America/Mexico_City');
    }
    public function setUpdatedAtAttribute($value)
    {
        $this->attributes['updated_at'] = Carbon::now('America/Mexico_City');
    }
}
