<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnostic extends Model
{
    /** @use HasFactory<\Database\Factories\DiagnosticFactory> */
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'profile_id',
        'diagnostic_date',
        'western_diagnosis',
        'tcm_diagnosis',
        'severity',
        'symptoms',
        'pulse_quality',
        'tongue_description',
    ];

    public function patient(){
        return $this->belongsTo(Patient::class);
    }

    public function profile(){
        return $this->belongsTo(Profile::class);
    }

    public function treatments(){
        return $this->hasMany(Treatment::class);
    }
}
