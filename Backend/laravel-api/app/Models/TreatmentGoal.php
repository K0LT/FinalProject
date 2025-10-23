<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TreatmentGoal extends Model
{
    /** @use HasFactory<\Database\Factories\TreatmentGoalFactory> */
    use HasFactory;


    protected $fillable = [
        'patient_id',
        'title',
        'description',
        'priority',
        'status',
        'progress_percentage',
        'target_date',
        'treatment_methods',
    ];

    public function goalMilestones(){
        return $this->hasMany(GoalMilestone::class);
    }

    public function patient(){
        return $this->belongsTo(Patient::class);
    }
}
