<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mark>
 */
class MarkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'mark1' => $this->faker->numberBetween(0, 100),
            'mark2' => $this->faker->numberBetween(0, 100),
            'mark3' => $this->faker->numberBetween(0, 100),
            'mark4' => $this->faker->numberBetween(0, 100),
            'mark5' => $this->faker->numberBetween(0, 100),
            'student_id' => Student::factory()
        ];
    }
}
