<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\OrganicUnit;
use App\Models\Question;
use App\Models\Service;
use App\Models\ServiceType;
use App\Models\Tag;
use App\Models\User;

class EventSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Event::factory()->count(10)->create();
    }
}