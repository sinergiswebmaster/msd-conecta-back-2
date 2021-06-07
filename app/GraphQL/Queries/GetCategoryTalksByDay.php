<?php

namespace App\GraphQL\Queries;

use App\Models\{Talk, Category, Day, Group, Link};

class GetCategoryTalksByDay
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        $category_id = $args['category_id'];

        $category = Category::select('id', 'title', 'main_channel')->find($category_id);
        $days = Day::get();



        $days_array = [];
        foreach($days as $day) {

            $talks_array = [];
            $talks = Talk::select('id', 'title', 'type', 'starts_at', 'ends_at')
                ->where( 'category_id', $category_id )
                ->where('day_id', $day->id)
                ->orderBy('starts_at', 'ASC')
                ->get();


            $i = 0;
            foreach($talks as $talk) {

                $groups = $talk->groups;
                $groups_array = [];
                $i2 = 0;
                foreach( $groups as $group ) {

                    $links = Link::select('id', 'title', 'url')->where( 'group_id', $group->id )->where('talk_id', $talk->id)->get();

                    $groups_array[$i2] = (object) [ 'id' => $group->id, 'title' => $group->title, 'custom_links' => $links];


                    $i2++;
                }

                $talks_array[$i] = (object) [ 'id' => $talk->id, 'title' => $talk->title, 'type' => $talk->type, 'starts_at' => $talk->starts_at, 'ends_at' => $talk->ends_at, 'custom_groups' => $groups_array];
                $i++;
            }

            $days_array[$day->id] = (object) [
                'id' => $day->id,
                'title' => $day->title,
                'custom_talks' => $talks_array,
            ];

        }


        $days_collection = collect($days_array);

        $category_collection = collect([
            'id' => $category->id,
            'title' => $category->title,
            'main_channel' => $category->main_channel,

            'custom_days' => $days_collection
        ]);

        return $category_collection;

    }
}
