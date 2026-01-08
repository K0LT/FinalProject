<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ExercisePatient extends Pivot
{
    /** @use HasFactory<\Database\Factories\ExercisePatientFactory> */
    use HasFactory;

    use SoftDeletes;

    protected $table = 'exercise_patient';

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
