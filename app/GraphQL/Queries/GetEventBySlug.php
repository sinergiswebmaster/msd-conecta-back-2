<?php

namespace App\GraphQL\Queries;

use App\Models\Event;


class GetEventBySlug
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        $event_slug = $args['slug'];

        $e = Event::select(
            'id',
            'title',
            'slug',
            'description',
            'event_date',
            'playback_id',
            'translated_playback_id',
            'publish',
            'thumbnail',
            'status',
            'duration',
            'exam_typeform_id',
    		'survey_typeform_id',
        
            )
            ->where('slug', $event_slug)
            ->where(function($query) {
                $query->where('publish', true)
                ->orWhere('status', 'dryrun');
            })
            ->first();

        return $e;
    }
}
