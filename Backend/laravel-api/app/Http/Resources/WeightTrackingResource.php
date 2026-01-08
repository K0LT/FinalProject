<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WeightTrackingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                   => $this->id,
            'patient_id'           => $this->patient_id,
            'weight'               => $this->weight,
            'body_fat_percentage'  => $this->body_fat_percentage,
            'measurement_date'     => $this->measurement_date,
            'notes'                => $this->notes,
        ];
    }
}
