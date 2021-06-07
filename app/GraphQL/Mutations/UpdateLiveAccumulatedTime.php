<?php

namespace App\GraphQL\Mutations;

use App\Models\Tracking;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Jenssegers\Agent\Agent;

class UpdateLiveAccumulatedTime
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
    public function __invoke($rootValue, array $args)
    {
        $eventID = $args['event_id'];
        $milliseconds = $args['milliseconds'];
        $seconds = $milliseconds/1000;

        $live_tracking = Tracking::select('id','accumulated_time')
                    ->where('user_id', Auth::guard('api')->user()->id)
                    ->where('event_id', $eventID)
                    ->orderBy('id','desc')
                    ->first();

        if( !$live_tracking ) {
            $agent = new Agent();
            $device = ($agent->isDesktop() ? 'escritorio' : 'móvil' );
            $platform = $agent->platform();
            $browser = $agent->browser();

            $attr = [
                'user_id' => Auth::guard('api')->user()->id,
                'played_at' => Carbon::now('America/Mexico_City'),
                'accumulated_time' =>'00:00:00',

                'event_id' => $eventID, //<- check this out
                'status' => 'live',  //<- check this out

                'device' => $device,
                'OS' => $platform,
                'browser' => $browser,

                'created_at' => Carbon::now('America/Mexico_City')
            ];
            $live_tracking = Tracking::create($attr);

            return $live_tracking;
        }

        $prevTime = $live_tracking->accumulated_time;
        $accumulated_time = Carbon::parse($prevTime)->addSeconds($seconds)->format('H:i:s');

        $live_tracking->accumulated_time = $accumulated_time;
        $live_tracking->save();

        return $live_tracking;
    }
}
