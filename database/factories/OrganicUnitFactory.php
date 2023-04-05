<?php

namespace Database\Factories;

use App\Models\OrganicUnit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrganicUnit>
 */
class OrganicUnitFactory extends Factory
{   
    protected $model = OrganicUnit::class;
    /** 
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=> $this->faker->name,
        ];
    }
}
