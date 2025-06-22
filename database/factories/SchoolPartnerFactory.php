<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SchoolPartner>
 */
class SchoolPartnerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
         return [
            'school_name' => fake()->company . ' School',
            'contact_person' => fake()->name,
            'email' => fake()->unique()->safeEmail,
            'num_students' => fake()->numberBetween(100, 200),
            'status' => fake()->randomElement(['active', 'inactive']),
        ];
    }
}
