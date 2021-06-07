<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    public function trackings()
    {
        return $this->hasMany(Tracking::class);
    }

    public function messages()
    {
      return $this->hasMany(Message::class);
    }
}
