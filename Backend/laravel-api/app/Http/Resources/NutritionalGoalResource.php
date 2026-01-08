<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NutritionalGoalResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                    => $this->id,
            'patient_id'            => $this->patient_id,
            'target_weight'         => $this->target_weight,
            'target_body_fat'       => $this->target_body_fat,
            'daily_calories_goal'   => $this->daily_calories_goal,
            'daily_protein_goal'    => $this->daily_protein_goal,
            'daily_carbs_goal'      => $this->daily_carbs_goal,
            'daily_fat_goal'        => $this->daily_fat_goal,
            'start_date'            => $this->start_date,
            'target_date'           => $this->target_date,
        ];
    }
}
