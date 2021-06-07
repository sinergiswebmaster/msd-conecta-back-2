<?php

namespace App\GraphQL\Queries;

use Carbon\Carbon;
use App\Models\{Talk, Category, Day, Group, Link};

class GetCurrentTalk
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        $category_id = $args['category_id'];
        $day_id = $args['day_id'];

        $currentHour = Carbon::now('America/Mexico_City')->toTimeString();

        //$currentHour = '09:05:00';
        //$day_id = 2;

        $talk = Talk::select('id', 'title', 'type', 'starts_at', 'ends_at')->where( 'category_id', $category_id )
                        ->where('day_id', $day_id)

                      ->whereTime('starts_at', '<=', $currentHour)
                        ->orderBy('starts_at', 'DESC')
                        ->first();

        if( !$talk )
          return null;

        $groups = $talk->groups;
        $groups_collection = [];
        $i2 = 0;
        foreach( $groups as $group ) {

          $links = Link::select('id', 'title', 'url')->where( 'group_id', $group->id )->where('talk_id', $talk->id)->get();

          $groups_collection[$i2] = (object) [ 'id' => $group->id, 'title' => $group->title, 'custom_links' => $links];

          $i2++;
        }



        $talk_collection = collect([
            'id' => $talk->id,
            //'status' => $talk->status,
            'title'  => $talk->title,
            'starts_at' => $talk->starts_at,
            'ends_at' => $talk->ends_at,

            'custom_groups' => $groups_collection,
        ]);

        return $talk_collection;
    }
}
