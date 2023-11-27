<?php

namespace Database\Factories;

use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory
 */
class RouteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => "RT_002" . str_pad($this->faker->numberBetween(1, 100), 3, 0, STR_PAD_LEFT),
            'description' => ucfirst($this->faker->word()). ' - ' . ucfirst($this->faker->word()) . ' '. $this->faker->sentence,
            'start_location_id' => Location::get()->random()->id,
            'end_location_id' => Location::get()->random()->id,
            'distance' => str_pad($this->faker->numberBetween(30, 154), 3, 0, STR_PAD_LEFT),
                     
        ];
    }
}