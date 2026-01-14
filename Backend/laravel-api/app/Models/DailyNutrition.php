<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DailyNutrition extends Model
{
    /** @use HasFactory<\Database\Factories\DailyNutritionFactory> */
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'patient_id',
        'date',
        'calories_consumed',
        'protein_consumed',
        'carbs_consumed',
        'fat_consumed',
        'water_intake',
        'steps',
        'sleep_hours',
        'calories_burned',
    ];

    public function patient(){
        return $this->belongsTo(Patient::class);
    }
}
