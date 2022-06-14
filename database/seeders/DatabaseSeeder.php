<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            EmployeeTypeSeeder::class,
            EmployeeSeeder::class,
            BranchSeeder::class,
            SubjectSeeder::class,
            GsOfficeSeeder::class,
            EmployeeSubjectSeeder::class,
            ServiceTypeSeeder::class,
            CustomerSeeder::class,
            ServiceRequestSeeder::class,
            EnrollmentSeeder::class,
        ]);
    }
}
