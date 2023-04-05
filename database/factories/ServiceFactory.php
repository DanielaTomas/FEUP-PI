<?php

namespace Database\Factories;

use App\Models\Service;
use App\Models\ServiceType;
use App\Models\User;
use App\Models\OrganicUnit;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{   
    protected $model = Service::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start_date = Carbon::now();
        $end_date = Carbon::now()->addDays(30);
        return [
            'servicename' => $this->faker->word,
            'requeststatus' => $this->faker->randomElement(['Accepted', 'Pending', 'Rejected']),
            'requesttype' => $this->faker->randomElement(['Create', 'Edit','Archive']),
            'purpose' => $this->faker->sentence,
            'email' => $this->faker->safeEmail,
            'contactperson' => $this->faker->name,
            'url' => $this->faker->url,
            'startdate' => $start_date,
            'enddate' => $end_date,
            'servicetypeid' => $this->faker->numberBetween(1,10),
        ];
    }
}
