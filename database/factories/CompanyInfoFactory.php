<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CompanyInfo>
 */
class CompanyInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_name' => $this->faker->company(),
            'address_ru' => $this->faker->address(),
            'address_ua' => $this->faker->address(),
            'email' => $this->faker->unique()->safeEmail(),
            'active' => 1,
            'logo' => $this->faker->image(storage_path('app/public/images/logo/'), 150, 100, null, false),
        ];
    }
}
