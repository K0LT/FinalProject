<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TreatmentGoal extends Model
{
    /** @use HasFactory<\Database\Factories\TreatmentGoalFactory> */
    use HasFactory;

    public function goalMilestones(){
        return $this->hasMany(GoalMillestone::class);
    }

    public function patient(){
        return $this->belongsTo(Patient::class);
    }
}
