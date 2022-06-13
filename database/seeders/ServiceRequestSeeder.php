<?php

namespace Database\Seeders;

use App\Models\ServiceRequest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ServiceRequest::factory(10)->create();
        $serviceRequests = ServiceRequest::all();
        $number = 0;
        foreach ($serviceRequests as $serviceRequest) {
            $serviceType = $serviceRequest->serviceType;
            $initialSubject = $serviceType->initialSubject;
            $branch = $initialSubject->branch;
            $number += 1;
            $serviceRequest->update([
                "number" => $number
            ]);
        }
    }
}
