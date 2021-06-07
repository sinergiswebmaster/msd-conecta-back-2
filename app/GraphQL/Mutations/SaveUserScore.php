<?php

namespace App\GraphQL\Mutations;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Score;


class SaveUserScore
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        $my_score = $args['score'];
        $user_id = Auth::guard('api')->user()->id;

        $score = Score::select('id')
                ->where('user_id', $user_id)
                ->first();

        if(!$score) {
            $score = Score::create([
                'user_id' => $user_id,
                'score' => $my_score,
                'try' => 0
                ]);
            }
                   

        $score->increment('try');

        return $score;
    }
}
