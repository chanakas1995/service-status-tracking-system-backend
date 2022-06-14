<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EnrollmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'service_request' => new ServiceRequestResource($this->serviceRequest),
            'subject' => new SubjectResource($this->subject),
            'employee_id' =>  new EmployeeResource($this->employee),
            'transferred_date' => $this->transferred_date,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
        ];
    }
}
