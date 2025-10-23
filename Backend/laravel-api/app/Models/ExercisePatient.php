<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExercisePatient extends Model
{
    /** @use HasFactory<\Database\Factories\ExercisePatientFactory> */
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'exercise_id',
        'profile_id',
        'prescribed_date',
        'frequency',
        'status',
        'compliance_rate',
        'last_performed',
        'notes',
    ];

    public function profile(){
        return $this->belongsTo(Profile::class);
    }
}
