<?php

namespace App\GraphQL\Mutations;

use App\Events\MessageSent;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use App\Models\{User, Message, Category};
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Chat
{
    /**
     * Return a value for the field.
     *
     * @param  null  $rootValue Usually contains the result returned from the parent field. In this case, it is always `null`.
     * @param  mixed[]  $args The arguments that were passed into the field.
     * @param  \Nuwave\Lighthouse\Support\Contracts\GraphQLContext  $context Arbitrary data that is shared between all fields of a single query.
     * @param  \GraphQL\Type\Definition\ResolveInfo  $resolveInfo Information about the query itself, such as the execution state, the field name, path to the field from the root, and more.
     * @return mixed
     */

    public function toFilterer($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $user_id = Auth::guard('api')->user()->id;
        $event_id = $args['event_id'];
        $message = $this->createMessage($user_id, $event_id, $args['message']);

        $user = $this->getUser();
        broadcast(new MessageSent($user, $message, 'filterer-chat'));

        return $message;
    }

    public function toSupport($rootValue, array $args)
    {
        $message_id = $args['message_id'];

        Message::where('id', $message_id)->update(['has_support' => 1]);
        $message = Message::select('id', 'user_id', 'event_id', 'message')
                            ->where('id', $message_id)->first();

        $user = $this->getUser($args['user_id']);
        broadcast(new MessageSent($user, $message, 'support-chat'));

        return $message;
    }

    public function toSpeaker($rootValue, array $args)
    {
        $message_id = $args['message_id'];

        Message::where('id', $message_id)->update(['to_speaker' => 1]);
        $message = Message::select('id', 'user_id', 'event_id', 'message')
                        ->where('id', $message_id)->first();

        $user = $this->getUser($args['user_id']);
        broadcast(new MessageSent($user, $message, 'speaker-chat'));

        return $message;
    }

    public function toUser($rootValue, array $args)
    {
        $event_id = $args['event_id'];

        $from_user_id = Auth::guard('api')->user()->id;
        $c_message = $args['message'];
        $to_user_id = $args['to_user_id'];
        $message_id = $args['message_id'];

        $message = Message::create(
            [
              'message' => $c_message,
              'user_id' => $from_user_id,
              'event_id' => $event_id,
              'to_user' => $to_user_id
            ]
          );

        Message::where('id', $message_id)->update(['to_message' => $message->id]);

        $user = $this->getUser($to_user_id);
        //dd($user->id);
        //dd( 'users-chat-' . $user->id );
        broadcast(new MessageSent($user, $message, 'users-chat-' . $user->id));

        return $message;
    }


    protected function getUser($user_id = false )
    {
        ($user_id) ? $user_id : $user_id = Auth::guard('api')->user()->id;

        $user = User::select('id', 'name', 'last_name', 'last_name')
                    /*->with(array('country' =>function($query){
                        $query->select('id', 'name');
                    }))*/
                    ->where('id', $user_id)->first();

        return $user;
    }

    protected function createMessage($user_id, $event_id, $message)
    {
        return Message::create(
            [
              'message' => $message,
              'user_id' => $user_id,
              'event_id' => $event_id,
            ]
            );
    }
}