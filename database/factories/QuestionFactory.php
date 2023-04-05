<?php

namespace Database\Factories;

use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{   
    protected $model = Question::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'question1' => $this->faker->sentence,
            'question2' => $this->faker->optional()->sentence,
            'question3' => $this->faker->optional()->sentence,
            'question4' => $this->faker->optional()->sentence,
            'question5' => $this->faker->optional()->sentence,
            'question6' => $this->faker->optional()->sentence,
            'question7' => $this->faker->optional()->sentence,
            'question8' => $this->faker->optional()->sentence,
            'question9' => $this->faker->optional()->sentence,
            'question10' => $this->faker->optional()->sentence,
        ];
    }
}
