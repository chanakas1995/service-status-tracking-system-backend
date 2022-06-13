<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\ServiceRequest;
use App\Models\ServiceType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ServiceRequest>
 */
class ServiceRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $startDate = $this->faker->dateTimeBetween('-6 months', 'now');
        return [
            'description' => $this->faker->paragraph(3),
            'start_date' => $startDate,
            'end_date' => $this->faker->dateTimeBetween($startDate, 'now'),
            'service_type_id' => ServiceType::all()->random()->id,
            'customer_id' => Customer::all()->random()->id,
            'notes' => $this->faker->paragraph(3),
        ];
    }
}
