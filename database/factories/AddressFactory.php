<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'village' => $this->faker->address(),
            'district' => $this->faker->address(),
            'regency' => $this->faker->address(),
            'province' => $this->faker->address(),
            'user_id' => User::factory(),
        ];
    }
}
