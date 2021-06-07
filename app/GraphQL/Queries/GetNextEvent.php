<?php

namespace App\GraphQL\Queries;

use App\Models\Event;

class GetNextEvent
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        $slug = $args['event_slug'];

        $event_id = Event::select('id')->where('slug', $slug)->first();

        $e = Event::select('id', 'event_date')
        ->where(function($query) {
                $query->where('status', 'idle')
                ->orWhere('status', 'upcoming')
                ->orWhere('status', 'finished')
                ->orWhere('status', 'live');
                    })
        
        ->where('slug', '<>', $slug)
        ->where('id', '>', $event_id->id)
        ->orderBy('id', 'asc')
        ->first();
                    
        return $e;
    }
}
