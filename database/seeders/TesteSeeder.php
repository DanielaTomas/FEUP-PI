<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\Tag;
use App\Models\User;
use App\Models\OrganicUnit;
use App\Models\Formation;
use Overtrue\LaravelVersionable\Version;

class TesteSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){

        $organicUnits = OrganicUnit::factory()->count(10)->create();
        $users = User::factory()->count(10)->create();

        $roles = ['GI', 'Administrator',null];

        foreach ($users as $user) {
            $role = $roles[array_rand($roles)];
            if ($role === null) continue;   
            $organicUnit = $organicUnits->random();
            Formation::create([
                'roletype' => $role,
                'userid' => $user->userid,
                'organicunitid' => $organicUnit->organicunitid,
            ]);
        }



        $events = Event::factory()->count(10)->create();
        $tags = Tag::factory()->count(20)->create();

        $i=0;
        foreach($users as $user){
            $user->events()->attach($events[i]);
            $events[i]->users()->attach($user);
            $i+=1;
        }

        TODO:
        acho que a relação entre users e events está errada
        ou é 1 para infinitos ou tou a fazer mal

        foreach ($events as $event) {
            $event->tags()->attach($tags->random(3));
            $user=$event->users()->get();
            Version::create([
                'versionable_type' => get_class($event),
                'versionable_id' => $event->eventid,
                'data' => $event->toArray(),
            ],$user->userid);
        }

       

    }
}