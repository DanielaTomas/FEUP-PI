<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\Tag;

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
        }
    }
}