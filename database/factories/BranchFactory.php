<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Branch>
 */
class BranchFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => ucfirst($this->faker->word()) . " Branch",
            'code' => "B" . str_pad($this->faker->numberBetween(1, 100), 3, 0, STR_PAD_LEFT),
            'branch_head_id' => Employee::whereHas(('employeeType'), function ($query) {
                return $query->where('type', "Subject Clerk");
            })->get()->random()->id,
        ];
    }
}
