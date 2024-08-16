<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
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
            'name' => implode(' ', array_filter([$this->first_name, $this->middle_name, $this->last_name])),
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'last_name' => $this->last_name,
            'department' => new DepartmentResource($this->department),
            'city' => new CityResource($this->city),
            'state' => new StateResource($this->state),
            'country' => new CountryResource($this->country),
            'zip' => $this->zip,
            'address' => $this->address,
            'birthdate' => $this->birthdate,
            'date_hired' => $this->date_hired,
            'created_at' => $this->created_at->diffForHumans(),
            'updated_at' => frontendFormattedDate($this->updated_at),
        ];
    }
}
