<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
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
            'patient_id' => $this->patient_id,
            'patient_name' => $this->patient->user->name,
            'appointment_date_time' => $this->appointment_date_time,
            'duration' => $this->duration,
            'type' => $this->type,
            'notes' => $this->notes,
            'status' => $this->status,
            'email' => $this->patient->user->email,
            'phone_number' => $this->patient->phone_number,
        ];
    }
}
