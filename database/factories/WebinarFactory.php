<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Webinar>
 */
class WebinarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->name(),
            'subtitle' => $this->faker->name(),
            'description' => $this->faker->text(),
            'video_url' => $this->faker->randomElement([
                'https://www.youtube.com/watch?v=1QneDREpZig&t=20s', 
                'https://www.youtube.com/watch?v=HK_146nJSWU', 
                'https://youtu.be/HK_146nJSWU'
            ]),
        ];
    }
}
