<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyNutrition extends Model
{
    /** @use HasFactory<\Database\Factories\DailyNutritionFactory> */
    use HasFactory;

    public function patient(){
        return $this->belongsTo(Patient::class);
    }
}
