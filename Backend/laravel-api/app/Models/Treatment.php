<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Treatment extends Model
{
    /** @use HasFactory<\Database\Factories\TreatmentFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'diagnostic_id',
        'patient_id',
        'session_date_time',
        'treatment_methods',
        'acupoints_used',
        'duration',
        'notes',
        'next_session',
    ];


    public function diagnostic(){
        return $this->belongsTo(Diagnostic::class);
    }

    public function patient(){
        return $this->belongsTo(Patient::class);
    }

}
