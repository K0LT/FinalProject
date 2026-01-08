<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                         => $this->id,
            'user_id'                    => $this->user_id,
            'phone_number'               => $this->phone_number,
            'address'                    => $this->address,
            'gender'                     => $this->gender,
            'birth_date'                 => $this->birth_date,
            'emergency_contact_name'     => $this->emergency_contact_name,
            'emergency_contact_phone'    => $this->emergency_contact_phone,
            'emergency_contact_relation' => $this->emergency_contact_relation,
            'client_since'               => $this->client_since,
            'last_visit'                 => $this->last_visit,
            'next_appointment'           => $this->next_appointment,
        ];
    }
}
