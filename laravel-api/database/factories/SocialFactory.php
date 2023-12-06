<?php

namespace Database\Factories;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Social>
 */
class SocialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'url' => $this->faker->url(),
            'social' => $this->faker->randomElement(['Facebook', 'Instagran', 'X', 'Linkedin', 'Other']),
            'restaurant_id' => Restaurant::all()->random()->id,
        ];
    }
}
