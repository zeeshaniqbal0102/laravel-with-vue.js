<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'country' => new CountryResource($this->country),
            'created_at' => $this->created_at->diffForHumans(),
            'updated_at' => frontendFormattedDate($this->updated_at),
        ];
    }
}
