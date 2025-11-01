<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    /** @use HasFactory<\Database\Factories\PatientFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'phone_number',
        'address',
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
        return $this->belongsToMany(Exercise::class, 'exercise_patients')
            ->withPivot('profile_id', 'prescribed_date', 'frequency', 'status', 'compliance_rate', 'last_performed', 'notes')
            ->withTimestamps();
    }

    public function weightTrackings(){
        return $this->hasMany(WeightTracking::class);
}

    public function nutritionGoals(){
        return $this->hasMany(NutritionalGoal::class);
    }

    public function allergies(){
        return $this->hasMany(Allergie::class);
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
}
