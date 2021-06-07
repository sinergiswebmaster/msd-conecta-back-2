<?php

namespace App\GraphQL\Queries;

use Illuminate\Support\Facades\Auth;
use App\Models\Message;

class MessagesByEvent
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        $user_id = Auth::guard('api')->user()->id;
        $event_id = $args['event_id'];

        $messages = Message::select('id', 'message', 'user_id')
                            ->where('event_id', $event_id)
                            ->where(function($query) use($user_id) {
                                $query->where('user_id', $user_id)
                                    ->orWhere('to_user', $user_id);
                            })
                        ->get();

        return $messages;  
    }
}
