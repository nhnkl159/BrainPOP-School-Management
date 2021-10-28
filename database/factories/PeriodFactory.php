<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Teacher;

class PeriodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'teacher_id' => Teacher::all()->random()->id,
            'name' => $this->faker->jobTitle() //I guess lol
        ];
    }
}
