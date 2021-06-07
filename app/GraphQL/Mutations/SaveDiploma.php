<?php

namespace App\GraphQL\Mutations;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Score;


class SaveDiploma
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {

        $user_id = Auth::guard('api')->user()->id;

        $score = Score::select('id')
                ->where('user_id', $user_id)
                ->first();

        if(!$score) {
            $score = Score::create([
                'user_id' => $user_id,
                'score' => 0,
                'try' => 0
                ]);
            }
        
        $score->downloaded = true;
        $score->downloaded_at = Carbon::now('America/Mexico_City');
        $score->save();

        return $score;
    }
}
