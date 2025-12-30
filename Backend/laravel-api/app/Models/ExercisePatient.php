<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExercisePatient extends Model
{
    /** @use HasFactory<\Database\Factories\ExercisePatientFactory> */
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'patient_id',
        'exercise_id',
        'prescribed_date',
        'frequency',
        'status',
        'compliance_rate',
        'last_performed',
        'notes',
    ];

}
