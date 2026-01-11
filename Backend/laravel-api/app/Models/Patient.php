<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    /** @use HasFactory<\Database\Factories\PatientFactory> */
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'phone_number',
        'address',
        'gender',
        'birth_date',
        'emergency_contact_name',
        'emergency_contact_phone',
        'emergency_contact_relation',
        'client_since',
        'last_visit',
        'next_appointment',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function appointments(){
        return $this->hasMany(Appointment::class);
    }

    public function diagnostics(){
        return $this->hasMany(Diagnostic::class);
    }

    public function treatments(){
        return $this->hasMany(Treatment::class);
    }

    public function treatmentGoals(){
        return $this->hasMany(TreatmentGoal::class);
    }

    public function exercises(){
        return $this->belongsToMany(Exercise::class, 'exercise_patient')
            ->using(ExercisePatient::class)
            ->withPivot('prescribed_date', 'frequency', 'status', 'compliance_rate', 'last_performed', 'actual_number', 'target_number', 'notes')
            ->withTimestamps()
            ->wherePivotNull('deleted_at');
    }

    public function weightTrackings(){
        return $this->hasMany(WeightTracking::class);
}

    public function nutritionalGoals(){
        return $this->hasMany(NutritionalGoal::class);
    }


    public function conditions(){
        return $this->hasMany(Condition::class);
    }

    public function progressNotes(){
        return $this->hasMany(ProgressNote::class);
    }

    public function dailyNutritions(){
        return $this->hasMany(DailyNutrition::class);
    }

    public function allergies()
    {
        return $this->belongsToMany(Allergy::class, 'allergy_patient')
            ->using(AllergyPatient::class)
            ->withTimestamps()
            ->withPivot('deleted_at')
            ->wherePivotNull('deleted_at');
    }

    public function updateNextAppointment()
    {
        $nextAppointment = $this->appointments()
            ->where('status', 'Confirmado')
            ->where('appointment_date_time', '>=', now())
            ->orderBy('appointment_date_time', 'asc')
            ->first();

        $this->next_appointment = $nextAppointment?->appointment_date_time;
        $this->save();
    }

}
