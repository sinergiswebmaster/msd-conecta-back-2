<?php

namespace App\GraphQL\Queries;

use App\Models\Event;

class GetVodEvents
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        $current_event_id = $args['current_event_id'];

        $e = Event::select('id', 'title', 'slug')
        ->where('status', 'vod')
        ->where('id', '<>', $current_event_id)
        ->get();

        return $e;
    }
}
