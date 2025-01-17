<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DriverResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => [
                'first' => $this->first_name,
                'middle' => $this->middle_name,
                'last' => $this->last_name,
            ],
            'personal_details' => [
                'civil_status' => $this->civil_status,
                'birthday' => $this->birthday,
                'age' => $this->age,
            ],
            'contact_details' => [
                'address' => $this->address,
                'contact_number' => $this->contact_number,
                'contact_person' => $this->contact_person,
            ],
            'government_ids' => [
                'pagibig_no' => $this->pagibig_no,
                'philhealth_no' => $this->philhealth_no,
                'sss_no' => $this->sss_no,
                'tin_no' => $this->tin_no,
            ],
            'license_details' => [
                'license_number' => $this->license_number,
                'license_expired' => $this->license_expired,
            ],
            'image' => $this->image,
            'status' => $this->status,
            'timestamps' => [
                'created_at' => $this->created_at->toDateTimeString(),
                'updated_at' => $this->updated_at->toDateTimeString(),
            ],
        ];

    }
}
