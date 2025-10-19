<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appointment extends Model
{
    /** @use HasFactory<\Database\Factories\AppointmentFactory> */
    use HasFactory;
    public function patient(){
        return $this->belongsTo(Patient::class);
    }

    public function profile(){
        return $this->belongsTo(Profile::class);
    }

    public function progressNotes(){
        return $this->hasMany(ProgressNote::class);
    }
}
