<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DailyNutritionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                 => $this->id,
            'patient_id'         => $this->patient_id,
            'date'               => $this->date,
            'calories_consumed'  => $this->calories_consumed,
            'protein_consumed'   => $this->protein_consumed,
            'carbs_consumed'     => $this->carbs_consumed,
            'fat_consumed'       => $this->fat_consumed,
            'water_intake'       => $this->water_intake,
            'steps'              => $this->steps,
            'sleep_hours'        => $this->sleep_hours,
            'calories_burned'    => $this->calories_burned,
        ];
    }
}
