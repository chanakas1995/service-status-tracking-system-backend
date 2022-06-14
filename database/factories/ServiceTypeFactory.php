<?php

namespace Database\Factories;

use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ServiceType>
 */
class ServiceTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'service_type' => $this->faker->sentence(3),
            'code' => "ST" .str_pad($this->faker->numberBetween(1, 100), 3, 0, STR_PAD_LEFT),
            'initial_subject_id' => Subject::whereHas('employeeSubjects')->get()->random()->id,
        ];
    }
}
