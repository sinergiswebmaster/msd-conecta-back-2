<?php

namespace App\GraphQL\Queries;

use Carbon\Carbon;

class GetNow
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        //return "2021-05-01 09:05:00";
        return Carbon::now('America/Mexico_City');
    }
}
