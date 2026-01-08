<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GoalMilestoneResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                 => $this->id,
            'treatment_goal_id'  => $this->treatment_goal_id,
            'description'        => $this->description,
            'target_date'        => $this->target_date,
            'completed'          => (bool) $this->completed,
            'completion_date'    => $this->completion_date,
            'notes'              => $this->notes,
        ];
    }
}
