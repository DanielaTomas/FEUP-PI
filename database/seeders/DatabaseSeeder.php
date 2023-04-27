<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Event;
use App\Models\OrganicUnit;
use App\Models\Question;
use App\Models\Service;
use App\Models\ServiceType;
use App\Models\Tag;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $path = 'resources/sql/seed.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('Database seeded!');
        //User::factory()->count(10)->create();
        //$this->command->info('Users created!');
        //OrganicUnit::factory()->count(10)->create();
        //$this->command->info('Organic unit created!');
       // $this->call(UserRoleSeeder::class);
        //$this->command->info('Users/Organic  with pivot table created !');
        //$this->call(EventTagSeeder::class);
        //$this->command->info('Events/tags with pivot table created !');
        //Event::factory()->count(10)->create();
        //$this->command->info('Events created!');
        
        //Tag::factory()->count(10)->create();
        //$this->command->info('Tags created!');
        //Question::factory()->count(10)->create();
        //$this->command->info('Questions created!');
        //ServiceType::factory()->count(10)->create();
        //$this->command->info('ServiceType created!');
        //Service::factory()->count(10)->create();
        //$this->command->info('Service created!');
        
        
    }
}
