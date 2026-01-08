<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProgressNoteResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'              => $this->id,
            'patient_id'      => $this->patient_id,
            'appointment_id'  => $this->appointment_id,
            'note_date'       => $this->note_date,
            'subjective'      => $this->subjective,
            'objective'       => $this->objective,
            'assessment'      => $this->assessment,
            'plan'            => $this->plan,
        ];
    }
}
