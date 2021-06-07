<?php

namespace App\GraphQL\Mutations;

use App\Models\Message;

class MarkSpeakerReaded
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        $message_id = $args['message_id'];

        $message = Message::select('id')->find($message_id);
        return tap($message)->update(['speaker_readed' => 1]);
    }
}
