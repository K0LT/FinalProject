<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoalMillestone extends Model
{
    /** @use HasFactory<\Database\Factories\GoalMillestoneFactory> */
    use HasFactory;

    public function treatmentGoal(){
        return $this->belongsTo(TreatmentGoal::class);
    }
}
