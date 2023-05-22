<?php

namespace Database\Factories;

use App\Models\Province;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pharmacy_name' => $this->faker->company,
            'address' => $this->faker->address,
            'cp' => $this->faker->numberBetween(1000, 99999),
            'province_id' => Province::all()->random()->id,
            'town_id' => Province::all()->random()->id,
            'phone' => $this->faker->phoneNumber,
            'nif_1' => $this->faker->randomNumber(8) . $this->faker->randomLetter,
            'nif_2' => $this->faker->randomNumber(8) . $this->faker->randomLetter,
            'max_orders_per_month' => 3
        ];
    }
}
