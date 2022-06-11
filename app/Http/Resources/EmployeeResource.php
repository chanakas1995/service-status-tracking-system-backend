<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
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
            'id' => $this->id,
            'title' => $this->title,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'address' => $this->address,
            'code' => $this->code,
            'nic' => $this->nic,
            'date_of_birth' => $this->date_of_birth,
            'gender' => $this->gender,
            'mobile' => $this->mobile,
            'work' => $this->work,
            'home' => $this->home,
            'employee_type_id' => $this->employee_type_id,
            'user' => new UserResource($this->whenLoaded('user')),
        ];
    }
}
