<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'price' => random_int(1000,5000),
            'description' => $this->faker->paragraph(),
            'category' => $this->faker->word(),
            'stock' => random_int(1, 10),
        ];
    }
}
