<?php

namespace App\GraphQL\Mutations;

use App\Models\Message;

class MarkModeratorReaded
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        $message_id = $args['message_id'];

        $message = Message::select('id')->find($message_id);
        return tap($message)->update(['moderator_readed' => 1]);

    }
}
