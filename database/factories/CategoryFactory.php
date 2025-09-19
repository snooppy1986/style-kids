<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'group_number' => $this->faker->numberBetween(1, 3),
            'thumbnail' => $this->faker->image(storage_path('app/public/images/categories/'), 150, 100, null, false),
            'title_ru' => $title = $this->faker->unique()->word(),
            'title_ua' => $this->faker->unique()->word(),
            'slug' => \Illuminate\Support\Str::slug($title),
            'status' => 1
        ];
    }
}
