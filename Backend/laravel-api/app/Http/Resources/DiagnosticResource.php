<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DiagnosticResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                  => $this->id,
            'patient_id'          => $this->patient_id,
            'diagnostic_date'     => $this->diagnostic_date,
            'western_diagnosis'   => $this->western_diagnosis,
            'tcm_diagnosis'       => $this->tcm_diagnosis,
            'severity'            => $this->severity,
            'pulse_quality'       => $this->pulse_quality,
            'tongue_description'  => $this->tongue_description,
        ];
    }
}
