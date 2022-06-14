<?php

namespace Database\Seeders;

use App\Models\Enrollment;
use App\Models\ServiceRequest;
use App\Models\Subject;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EnrollmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $serviceRequests = ServiceRequest::all();
        $subjects = Subject::whereHas('employeeSubjects')->get();

        foreach ($serviceRequests as $serviceRequest) {
            $isCompleted = $faker->boolean();
            $subjectId = $serviceRequest->serviceType->initialSubject->id;
            $employeeId = $subjects->where('id', $subjectId)->first()->employeeSubjects->random()->employee_id;
            $enrollmentData = [
                "service_request_id" => $serviceRequest->id,
                "subject_id" => $subjectId,
                "employee_id" => $employeeId,
                'transferred_date' => $serviceRequest->start_date,
                'start_date' => $serviceRequest->start_date,
            ];
            if ($isCompleted) {
                $enrollmentData['end_date'] = $serviceRequest->end_date;
            } else {
                $serviceRequest->update(["end_date" => null]);
            }
            Enrollment::create($enrollmentData);
        }
    }
}
