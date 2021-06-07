<?php

namespace App\GraphQL\Queries;

use App\Models\Message;

class ReadedFilterer
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        $event_id = $args['event_id'];

        $messages = Message::where('event_id', $event_id)
          ->whereNull('to_user')
          ->where(function($query) {
            $query->where('has_support', 1)
              ->orWhere('to_speaker', 1)
              ->orWhere('mark_read', 1)
               ->orWhereNotNull('to_message');
        })
        ->orderBy('created_at', 'desc')
        ->get();

        return $messages;
    }
}
