<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\Tag;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{

    protected $model = Event::class;

    public function definition()
    {

        return [
            'requeststatus' => $this->faker->randomElement(['Accepted', 'Pending', 'Rejected']),
            'requesttype' => $this->faker->randomElement(['Create', 'Edit', 'Archive']),
            'eventname' => $this->faker->sentence(4),
            'address' => $this->faker->address,
            'url' => $this->faker->url,
            'email' => $this->faker->email,
            'datecreated' => $this->faker->dateTimeBetween('-4 week', '-3 week', 'UTC')->format('Y-m-d'),
            'datereviewed' => $this->faker->dateTimeBetween('-2 week', '-1 week', 'UTC')->format('Y-m-d'),
            'contactperson' => $this->faker->name,
            'description' => $this->faker->paragraph,
            'startdate' => $this->faker->dateTimeBetween('-1 week', '+1 week', 'UTC')->format('Y-m-d'),
            'enddate' => $this->faker->dateTimeBetween('+2 week', '+3 week', 'UTC')->format('Y-m-d'),
            'eventcanceled' => $this->faker->boolean(10), // 10% chance of being true 
            'userid' => $this->faker->numberBetween(1, 10),
            'organicunitid'  => $this->faker->numberBetween(1, 10),
        ];
    }
}
