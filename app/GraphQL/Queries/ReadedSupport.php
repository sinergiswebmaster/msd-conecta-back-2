<?php

namespace App\GraphQL\Queries;

use App\Models\Message;

class ReadedSupport
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        $event_id = $args['event_id'];

        $messages = Message::where('event_id', $event_id)

            ->where('has_support', 1)
            ->whereNotNull('to_message')
            ->orderBy('created_at', 'desc')
            ->get();

        return $messages;
    }
}
