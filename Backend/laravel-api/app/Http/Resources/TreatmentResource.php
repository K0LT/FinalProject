<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TreatmentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                  => $this->id,
            'diagnostic_id'        => $this->diagnostic_id,
            'patient_id'           => $this->patient_id,
            'session_date_time'    => $this->session_date_time,
            'treatment_methods'    => $this->treatment_methods,
            'acupoints_used'       => $this->acupoints_used,
            'duration'             => $this->duration,
            'notes'                => $this->notes,
            'next_session'         => $this->next_session,
        ];
    }
}
