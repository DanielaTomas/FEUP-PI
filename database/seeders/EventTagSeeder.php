<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\Tag;
use Overtrue\LaravelVersionable\Version;

class EventTagSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        $events = Event::factory()->count(10)->create();
        $tags = Tag::factory()->count(20)->create();

        foreach ($events as $event) {
            $event->tags()->attach($tags->random(3));
            Version::create([
                'versionable_type' => get_class($event),
                'versionable_id' => $event->eventid,
                'data' => $event->toArray(),
            ]);
        }
    }
}