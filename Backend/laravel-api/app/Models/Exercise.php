<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exercise extends Model
{
    /** @use HasFactory<\Database\Factories\ExerciseFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'category',
        'difficulty_level',
        'instructions',
        'benefits',
        'precautions',
        'video_url',
        'image_url',
    ];
    public function patients()
    {
        return $this->belongsToMany(Patient::class, 'exercise_patient')
            ->using(ExercisePatient::class)
            ->withPivot('prescribed_date', 'frequency', 'status', 'compliance_rate', 'last_performed', 'notes')
            ->withTimestamps()
            ->wherePivotNull('deleted_at');
    }
}
