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
            'title' => [
                'en' => $this->faker->title(),
                'ar' => $this->faker->title(),
            ],
            'description' => [
                'en' => $this->faker->paragraph(5),
                'ar' => $this->faker->paragraph(5),
            ],
            'image' => $this->faker->image(),
            'link' => $this->faker->url(),
        ];
    }
}
