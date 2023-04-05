<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'username' => $this->faker->unique()->userName,
            'name'=> $this->faker->name,
            'isadmin' => $this->faker->boolean,
            'email' => $this->faker->unique()->safeEmail,
            'password' => '12345',
            'userphoto' => $this->faker->imageUrl(200, 200, 'cats')
        ];
    }
}
