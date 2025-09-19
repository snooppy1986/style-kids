<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sku>
 */
class SkuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => $this->faker->unique()->bothify('SKU-#####??'),
            'price' => $this->faker->numberBetween(200, 10000),
            'discount_price' => $this->faker->optional()->numberBetween(100, 1999),
            'color' => $this->faker->randomElement(['red', 'blue', 'green', 'yellow', 'black', 'white', 'purple', 'orange', 'pink', 'brown']),
            'new' => $this->faker->boolean(30),
            'hit' => $this->faker->boolean(30),
        ];
    }
}
