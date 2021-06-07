<?php

namespace App\GraphQL\Mutations;

use App\Models\Question;
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;


class MarkAnsweredExam
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        $event_id = $args['event_id'];
        $user_id = Auth::guard('api')->user()->id;
        $question_type = $args['question_type'];
        // survey
        // exam_start
        // exam_finished


        $q = Question::select('id')
            ->where('user_id', $user_id)
            ->where('event_id', $event_id)
            ->first();

        if(!$q) {
            $q = new Question;
            $q->user_id = $user_id;
            $q[$question_type] = true;
            $q[$question_type.'_datetime'] = Carbon::now('America/Mexico_City');
            $q->event_id = $event_id;
            $q->save();
        }
        
        if($q) {
            $q[$question_type] = true;
            $q[$question_type.'_datetime'] = Carbon::now('America/Mexico_City');
            $q->save();	
        }

        return true;
    }
}
