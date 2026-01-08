<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoalMilestone extends Model
{
    /** @use HasFactory<\Database\Factories\GoalMilestoneFactory> */
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'treatment_goal_id',
        'description',
        'target_date',
        'completed',
        'completion_date',
        'notes',
    ];

    public function treatmentGoal(){
        return $this->belongsTo(TreatmentGoal::class);
    }
}
