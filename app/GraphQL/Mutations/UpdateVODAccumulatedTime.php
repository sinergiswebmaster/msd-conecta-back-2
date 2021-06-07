<?php

namespace App\GraphQL\Mutations;

use App\Models\Tracking;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use Jenssegers\Agent\Agent;

class UpdateVODAccumulatedTime
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        $eventID = $args['event_id'];
        $seeked = $args['seeked'];
        $milliseconds = $args['milliseconds'];
        $progress_time = $args['progress_time'];
        $video_duration = $args['video_duration'];

        $user_id = Auth::guard('api')->user()->id;

        $video_duration = $video_duration * 60;

        $seconds = $milliseconds/1000;

        $tracking = Tracking::select('id', 'progress_time','accumulated_time', 'percentage', 'video_duration')
            ->where('event_id', $eventID)
            ->where('user_id', $user_id)
            ->where('status', 'vod')
            ->orderBy('id','desc')
            ->first();


            //check this out
      if( !$tracking || $tracking->percentage >= 100  ) {

          $agent = new Agent();
          $device = ($agent->isDesktop() ? 'escritorio' : 'móvil' );
          $platform = $agent->platform();
          $browser = $agent->browser();

          $attr = [
              'user_id' => Auth::guard('api')->user()->id,
              'played_at' => Carbon::now('America/Mexico_City'),
              'accumulated_time' =>'00:00:00',

              'event_id' => $eventID,
              'status' => 'vod',

              'device' => $device,
              'OS' => $platform,
              'browser' => $browser,

              'created_at' => Carbon::now('America/Mexico_City')
          ];
          $tracking = Tracking::create($attr);

          return $tracking;
      }

        $progress_time = Carbon::createFromTimestamp($progress_time)->toTimeString();

        $prevTime = $tracking->accumulated_time;
        $accumulated_time = ($seeked) ? $prevTime : Carbon::parse($prevTime)->addSeconds($seconds)->format('H:i:s');


        //dd( $accumulated_time );
        $a = explode(':', $accumulated_time);
        $accumulated_time_seconds = ($a[0] * 3600) + ($a[1] * 60) + $a[2];
        //dd($accumulated_time_seconds);

        $video_duration = Carbon::createFromTimestamp($video_duration)->toTimeString();

        $d = explode(':', $video_duration);
        $video_duration_seconds = ($d[0] * 3600) + ($d[1] * 60) + $d[2];

        $d = explode(':', $progress_time);
        $progress_time_seconds = ($d[0] * 3600) + ($d[1] * 60) + $d[2];

        $step1 = $video_duration_seconds - $accumulated_time_seconds;
        $step2 = $step1 / $video_duration_seconds;
        $step3 = $step2 * 100;
        $percentage = 100 - intval($step3);

        $tracking->progress_time = $progress_time;
        $tracking->accumulated_time = $accumulated_time;
        $tracking->percentage = $percentage;
        $tracking->video_duration = $video_duration;

        $tracking->save();

        return $tracking;
    }
}
