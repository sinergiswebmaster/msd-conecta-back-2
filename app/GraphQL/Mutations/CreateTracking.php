<?php

namespace App\GraphQL\Mutations;

use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;
use Carbon\Carbon;
use App\Models\Tracking;

class CreateTracking
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {

        $event_id = $args['event_id'];
        $status = $args['status'];

        $agent = new Agent();
        $device = ($agent->isDesktop() ? 'escritorio' : 'móvil' );
        $platform = $agent->platform();
        $browser = $agent->browser();

        $user_id = Auth::guard('api')->user()->id;

        $tracking = null;
        $createTracking = null;

        if($status === 'live') {
        
            $tracking = Tracking::select('id')
                            ->where('user_id', $user_id)
                                ->where('event_id', $event_id)
                            ->where('status', $status)
                                ->first();
        }
  
        if($status === 'vod' || !$tracking ) {
            $createTracking =Tracking::create([
                            'accumulated_time' =>'00:00:00',
                            'progress_time' =>'00:00:00',
                            'video_duration' => 0,
                            'percentage' => 0,
                            'has_ended' => false,
                            'status' => $status,
                            'user_id' => $user_id,
        
                            'event_id' => $event_id,
                            'device' => $device,
                            'OS' => $platform,
                            'browser' => $browser, 
        
                            'played_at' => Carbon::now('America/Mexico_City')
                            ]);
        }
    
        return ($tracking || $createTracking) ? true : false;
    }
}
