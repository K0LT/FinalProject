<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NutritionalGoal extends Model
{
    /** @use HasFactory<\Database\Factories\NutritionalGoalFactory> */
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'patient_id',
        'target_weight',
        'target_body_fat',
        'daily_calories_goal',
        'daily_protein_goal',
        'daily_carbs_goal',
        'daily_fat_goal',
        'start_date',
        'target_date',
    ];

    public function patient(){
        return $this->belongsTo(Patient::class);
    }
}
