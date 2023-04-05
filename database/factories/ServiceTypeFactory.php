<?php

namespace Database\Factories;

use App\Models\ServiceType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ServiceType>
 */
class ServiceTypeFactory extends Factory
{   
    protected $model = ServiceType::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'servicetypename' => $this->faker->word(),
            'atribute1' => $this->faker->word(),
            'atribute2' => $this->faker->optional()->word(),
            'atribute3' => $this->faker->optional()->word(),
            'atribute4' => $this->faker->optional()->word(),
            'atribute5' => $this->faker->optional()->word(),
            'atribute6' => $this->faker->optional()->word(),
            'atribute7' => $this->faker->optional()->word(),
            'atribute8' => $this->faker->optional()->word(),
            'atribute9' => $this->faker->optional()->word(),
            'atribute10' => $this->faker->optional()->word(),
            'questionsid' => $this->faker->numberBetween(1,10),
        ];
    }
}
