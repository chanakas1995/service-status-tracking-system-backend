<?php

namespace Database\Seeders;

use App\Models\EmployeeSubject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EmployeeSubject::factory(20)->create();
    }
}
