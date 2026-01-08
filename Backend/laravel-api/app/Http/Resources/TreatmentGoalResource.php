<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TreatmentGoalResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                  => $this->id,
            'patient_id'          => $this->patient_id,
            'title'               => $this->title,
            'description'         => $this->description,
            'priority'            => $this->priority,
            'status'              => $this->status,
            'progress_percentage' => $this->progress_percentage,
            'target_date'         => $this->target_date,
            'treatment_methods'   => $this->treatment_methods,
        ];
    }
}
