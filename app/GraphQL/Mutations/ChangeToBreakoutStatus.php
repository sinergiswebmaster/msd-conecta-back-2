<?php

namespace App\GraphQL\Mutations;

use App\Models\{Event};

class ChangeToBreakoutStatus
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        $events = Event::select('id', 'status')->get();

        foreach($events as $event) {
            $event->status = 'breakout';
            $event->save();
        }

        return true;
    }
}
