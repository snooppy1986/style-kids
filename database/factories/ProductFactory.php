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
    public function definition(): array
    {
        $type = ['clothes', 'shoes', 'accessories'];
        return [
            'code' => $this->faker->unique()->numerify('SKU-#####'),
            'title_ru' => $title_ru = $this->faker->word(),
            'title_ua' => $title_ua = $this->faker->word(),
            'slug_ru' => \Illuminate\Support\Str::slug($title_ru),
            'slug_ua' => \Illuminate\Support\Str::slug($title_ua),
            'body_ru' => $this->faker->text(500),
            'body_ua' => $this->faker->text(500),
            'description_ru' => $this->faker->text(200),
            'description_ua' => $this->faker->text(200),            
            'thumbnail' => $this->faker->image(storage_path('app/public/images/products/'), 300, 300, null, false),
            'active' => 1,
            'type' => $type[array_rand($type)],
        ];
    }
}
