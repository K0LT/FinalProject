<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    /** @use HasFactory<\Database\Factories\AppointmentFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'patient_id',
        'appointment_date_time',
        'duration',
        'type',
        'notes',
        'status',
    ];

    public function patient(){
        return $this->belongsTo(Patient::class);
    }


    public function progressNotes(){
        return $this->hasMany(ProgressNote::class);
    }
}
