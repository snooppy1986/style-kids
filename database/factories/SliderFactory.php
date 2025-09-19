<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Slider>
 */
class SliderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'image'=> $this->faker->image(storage_path('app/public/images/sliders/'), 640, 480, 'cat', false),
            'body_ru' => $this->faker->sentence(10),
            'body_ua' => $this->faker->sentence(10),
            'active' => 1
        ];
    }
}
