<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\BaseModelDates;

class Tracking extends BaseModelDates
{
    use HasFactory;

    protected $fillable = [
        'accumulated_time',
        'progress_time',
        'video_duration',
        'percentage',
        'has_ended',
        'status',
        'user_id', 
        'device', 
        'OS', 
        'browser', 
        'played_at',
        'event_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
