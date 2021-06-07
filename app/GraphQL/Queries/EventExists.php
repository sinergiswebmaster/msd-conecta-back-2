<?php

namespace App\GraphQL\Queries;

use App\Models\Event;

class EventExists
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        $slug = $args['slug'];

        $e = Event::select('id')->where('slug', $slug)->first();

        return $e;
    }
}
