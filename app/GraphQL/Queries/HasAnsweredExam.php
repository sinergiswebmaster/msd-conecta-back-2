<?php

namespace App\GraphQL\Queries;

use App\Models\Question;

use Illuminate\Support\Facades\Auth;

class HasAnsweredExam
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
            ->where($question_type, true)
            ->exists();

        return $q;
    }
}
