<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Detail>
 */
class DetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->address(),
            'phone' => $this->faker->phoneNumber(),
            'street' => $this->faker->address(),
            'province' => $this->faker->address(),
            'city' => $this->faker->address(),
            'district' => $this->faker->address(),
            'postal' => $this->faker->address(),
            'addition' => $this->faker->address(),
            'user_id' => User::factory(),
        ];
    }
}
