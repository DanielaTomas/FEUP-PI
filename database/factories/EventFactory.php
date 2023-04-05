<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\Tag;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory{

    protected $model = Event::class;

    public function definition(){
        return [
            'requestStatus' => $this->faker->randomElement(['Accepted', 'Pending', 'Rejected', 'Old']),
            'requestType' => $this->faker->randomElement(['Create', 'Edit', 'Archive']),
            'eventName' => $this->faker->sentence(4),
            'address' => $this->faker->address,
            'url' => $this->faker->url,
            'email' => $this->faker->email,
            'dateCreated' => $this->faker->date(),
            'dateReviewed' => $this->faker->date(),
            'contactPerson' => $this->faker->name,
            'description' => $this->faker->paragraph,
            'startDate' => $this->faker->dateTimeBetween('-1 month', '+1 month')->format('Y-m-d'),
            'endDate' => $this->faker->dateTimeBetween('+1 month', '+2 month')->format('Y-m-d'),
            'eventCanceled' => $this->faker->boolean(10),
            'version' => $this->faker->numberBetween(1, 5),
            'tagId' => Tag::factory(),
        ];
    }
}
