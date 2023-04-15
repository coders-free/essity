<?php

namespace Database\Factories;

use App\Models\Category;
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
        return [
            'code' => $this->faker->numberBetween(100000000, 999999999),
            'name' => $this->faker->name(),
            'details' => $this->faker->text(),
            'image' => $this->faker->imageUrl(),
            'category_id' => Category::all()->random()->id,
        ];
    }
}
