<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BusResource extends JsonResource
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
            "id" => $this->id,
            "name" => $this->name,
            "reg_number" => $this->reg_number,
            "chassis_no" => $this->chassis_no,
            "engine_no" => $this->engine_no,
            "seat_count" => $this->seat_count,
            "model" =>  new BusModelResource($this->whenLoaded('busModel')),
        ];
    }
}