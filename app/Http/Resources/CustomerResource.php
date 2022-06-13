<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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
            'name' => $this->name,
            'address' => $this->address,
            'nic' => $this->nic,
            'date_of_birth' => $this->date_of_birth,
            'gender' => $this->gender,
            'mobile' => $this->mobile,
            'home' => $this->home,
            'user' => new UserResource($this->whenLoaded('user')),
            'gs_office' => new GsOfficeResource($this->whenLoaded('gsOffice')),
        ];
    }
}
