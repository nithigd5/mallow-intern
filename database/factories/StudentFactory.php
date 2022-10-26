<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'dob' => $this->faker->date,
            'mobile' => $this->faker->unique()->regexify("[6-9][0-9]{9}"),
            'gender' => $this->faker->randomElement(['male', 'female', null]),
            'address' => $this->faker->address,
        ];
    }
}
