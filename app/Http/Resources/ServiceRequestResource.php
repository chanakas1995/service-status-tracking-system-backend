<?php

namespace App\Http\Resources;

use App\Models\Customer;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceRequestResource extends JsonResource
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
            'code' => $this->code,
            'description' => $this->description,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'service_type_id' => $this->service_type_id,
            'customer_id' => $this->customer_id,
            'notes' => $this->notes,
            "customer" => new CustomerResource($this->whenLoaded('customer')),
            "service_type" => new ServiceTypeResource($this->whenLoaded('serviceType')),
        ];
    }
}
