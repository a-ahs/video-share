<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Video>
 */
class VideoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'path' => $this->faker->imageUrl(446,240,'animals', true),
            'length' => $this->faker->randomNumber(3),
            'slug' => $this->faker->slug(),
            'descriptions' => $this->faker->text(),
            'thumbnail' => 'https://loremflickr.com/446/240/world?random=' . rand(1, 99),
            'category_id' => $this->faker->randomElement([1, 2, 3, 4, 5, 6, 7])
        ];
    }
}
