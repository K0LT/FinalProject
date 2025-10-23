<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    /** @use HasFactory<\Database\Factories\ExerciseFactory> */
    use HasFactory;

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
        return $this->belongsToMany(Patient::class, 'exercice_patients')
            ->withPivot('profile_id', 'prescribed_date', 'frequency', 'status', 'compliance_rate', 'last_performed', 'notes')
            ->withTimestamps();
    }
}
