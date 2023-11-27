<?php

namespace Database\Factories;

use App\Models\BusModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory
 */
class BusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => ucfirst($this->faker->word()) . " Bus",
            'reg_number' => substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, rand(2, 3)) . "-" . str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT),
            'chassis_no' => $this->faker->unique()->regexify('[A-Z0-9]{10}'),
            'engine_no' => $this->faker->unique()->regexify('[A-Z0-9]{10}'),
            
            'seat_count' => str_pad($this->faker->numberBetween(30, 54), 3, 0, STR_PAD_LEFT),
            'bus_model_id' => BusModel::get()->random()->id,
                     
        ];
    }
}