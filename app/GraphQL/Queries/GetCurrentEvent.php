<?php

namespace App\GraphQL\Queries;

use App\Models\Event;

class GetCurrentEvent
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        $e = Event::select('id', 'slug')
            ->where('redirect', true)
            ->first();

        return $e;
    }
}
