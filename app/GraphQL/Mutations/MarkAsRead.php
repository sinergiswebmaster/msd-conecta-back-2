<?php

namespace App\GraphQL\Mutations;

use App\Models\Message;

class MarkAsRead
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        $message_id = $args['message_id'];

        Message::where('id', $message_id)->update(['mark_read' => 1]);
        $message = Message::where('id', $message_id)->first();

        return $message;
    }
}
