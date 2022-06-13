<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EmployeeSubject>
 */
class EmployeeSubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'employee_id' => Employee::whereHas('employeeType', function ($q) {
                return $q->where('type', 'Subject Clerk');
            })->get()->random()->id,
            'subject_id' => Subject::all()->random()->id
        ];
    }
}
