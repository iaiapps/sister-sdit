<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Teacher>
 */
class TeacherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gender = fake()->randomElement(['male', 'female']);
        return [
            'full_name' => fake()->name($gender),
            'gender' => $gender,
            'place_of_birth' => fake()->city(),
            'date_of_birth' => fake()->date('d M Y'),
            'last_education' => fake()->name,
            'month_enter' => fake()->monthName(),
            'year_enter' => fake()->date('Y'),
            'no_hp' => fake()->phoneNumber(),
            'email' => fake()->email(),
        ];
    }
}
