<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
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
            'name' => [
                'en' => $this->faker->name,
                'ar' => $this->faker->name,
            ],
            'slug' => $this->faker->slug(),
            'img_path' => $this->faker->imageUrl
        ];
    }
}
