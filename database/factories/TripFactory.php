<?php

namespace Database\Factories;

use App\Models\Bus;
use App\Models\Route;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory
 */
class TripFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {  
         
        $startTime = $this->faker->dateTimeBetween('-1 day', '+1 day')->format('Y-m-d H:i:s');
        $startDateTime = \DateTime::createFromFormat('Y-m-d H:i:s', $startTime);
        $endDateTime = clone $startDateTime;
        $endDateTime->modify('+5 hours');
        $endTime = $endDateTime->format('Y-m-d H:i:s');
    
        return [
            'name' => "TRIP_002" . str_pad($this->faker->numberBetween(1, 100), 3, 0, STR_PAD_LEFT),
            'description' => $this->faker->sentence,
            'start_time' => $startDateTime,
            'end_time' => $endTime,
            'bus_id' => Bus::get()->random()->id,
            'route_id' => Route::get()->random()->id,
            
        ];
    }
}