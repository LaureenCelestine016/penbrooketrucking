<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VehicleResource extends JsonResource
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
            'vehicle_name' => $this->name,
            'vehicle_type' => $this->type,
            'chassis_no.' => $this->chassis_number,
            'engine_no.' => $this->engine_number,
            'registration_no.' => $this->registration_number,
            'registration_exp_date' => $this->registration_expiration_date,
            'license_plate' => $this->license_plate,
            'status' => $this->status,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
