<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
        $this->call(EventSeeder::class);
        $this->command->info('Events created!');
    }
}
