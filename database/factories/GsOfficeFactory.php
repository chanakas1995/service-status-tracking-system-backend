<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GsOffice>
 */
class GsOfficeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => ucfirst($this->faker->word()),
            'code' => "E".str_pad($this->faker->numberBetween(1,300), 3, 0, STR_PAD_LEFT),
            'address' => "No." . $this->faker->numberBetween(1, 100) . ' Main Street, Ibbagamuwa',
            'phone' => "35" . $this->faker->numberBetween(1111111, 9999999),
            'gs_acting_id' => Employee::whereHas(('employeeType'), function ($query) {
                return $query->where('type', "GS Officer");
            })->get()->random()->id,
            'gs_permanent_id' => Employee::whereHas(('employeeType'), function ($query) {
                return $query->where('type', "GS Officer");
            })->get()->random()->id,
        ];
    }
}
