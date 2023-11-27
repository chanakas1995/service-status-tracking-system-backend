<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TripResource extends JsonResource
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
            "description" => $this->description,
            "bus" =>new BusResource($this->whenLoaded('bus')),
            "route" => new RouteResource($this->whenLoaded('route')),
            "start_time" => $this->start_time,
            "end_time" => $this->end_time,
        ];
    }
}