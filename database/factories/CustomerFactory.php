<?php

namespace Database\Factories;

use App\Models\GsOffice;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $gender = $this->faker->boolean();
        $first_name = $this->faker->firstName($gender ? 'Male' : 'Female');
        $last_name = $this->faker->firstName($gender ? 'Male' : 'Female');
        $role = Role::where('name', "Customer")->get()->first();
        $username = $first_name . $this->faker->numberBetween(10, 99);
        $email = $username . '@example.com';
        $dateOfBirth = $this->faker->dateTimeBetween('-50 years', '-25 years');
        $nicDates = Carbon::parse($dateOfBirth)->setYear(2020)->dayOfYear();
        if (!$gender) {
            $nicDates += 500;
        }

        $user = User::create([
            "name" => $first_name . " " . $last_name,
            "username" => $username,
            "email" => $email,
        ]);

        $user->syncRoles($role);

        return [
            'title' => $this->faker->numberBetween($gender ? 4 : 1, $gender ? 4 : 3),
            'first_name' => $first_name,
            'last_name' => $last_name,
            'address' => "No." . $this->faker->numberBetween(1, 100) . ' Main Street, Ibbagamuwa',
            'nic' => Carbon::parse($dateOfBirth)->format('y') . str_pad($nicDates, 3, 0, STR_PAD_LEFT) . $this->faker->numberBetween(1111, 9999) . "V",
            'date_of_birth' => $dateOfBirth->format('Y-m-d'),
            'gender' => $gender ? 1 : 2,
            'mobile' => "71" . $this->faker->numberBetween(1111111, 9999999),
            'home' => "35" . $this->faker->numberBetween(1111111, 9999999),
            'gs_office_id' => GsOffice::all()->random()->id,
            'user_id' => $user->id,
        ];
    }
}
