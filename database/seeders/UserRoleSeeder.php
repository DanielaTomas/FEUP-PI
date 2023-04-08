<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\OrganicUnit;
use App\Models\Formation;

class UserRoleSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){//creates roles for ALL users, maybe change later
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

        
    }
}