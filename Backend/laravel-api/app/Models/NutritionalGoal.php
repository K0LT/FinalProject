<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NutritionalGoal extends Model
{
    /** @use HasFactory<\Database\Factories\NutritionalGoalFactory> */
    use HasFactory;

    public function patient(){
        return $this->belongsTo(Patient::class);
    }
}
