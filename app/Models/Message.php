<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\BaseModelDates;

class Message extends BaseModelDates
{
    use HasFactory;

    protected $fillable = ['message','user_id', 'event_id', 'to_user'];

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function event()
    {
      return $this->belongsTo(Event::class);
    }
}
