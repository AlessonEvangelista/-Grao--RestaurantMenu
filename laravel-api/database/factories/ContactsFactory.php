<?php

namespace Database\Factories;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contacts>
 */
class ContactsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create('pt_BR');

        $type = $this->faker->randomElement(['phone', 'email']);
        $contacts = $type === 'phone' ? $faker->phoneNumber() : $faker->email();

        return [
            'type' => $type,
            'contact' => $contacts,
            'restaurant_id' => Restaurant::all()->random()->id,
        ];
    }
}
