<?php

namespace App\GraphQL\Mutations;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Message;

class CreateMessage
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        $message = $args['message'];

        $user_id = Auth::guard('api')->user()->id;

        $newMessage = Message::create(
            [
              'message' => $message,
              'user_id' => $user_id,
              'created_at' => Carbon::now('America/Mexico_City'),
            ]
            );

        return $newMessage;
    }
}
