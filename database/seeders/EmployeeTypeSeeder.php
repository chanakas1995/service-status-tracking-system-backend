<?php

namespace Database\Seeders;

use App\Models\EmployeeType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class EmployeeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employeeTypes = [
            "Subject Clerk",
            "GS Officer",
        ];

        EmployeeType::destroy(EmployeeType::all()->pluck('id'));
        foreach ($employeeTypes as $employeeType) {
            EmployeeType::create([
                "id" => Uuid::uuid4()->toString(),
                "type" => $employeeType,
            ]);
        }
    }
}
