<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgressNote extends Model
{
    /** @use HasFactory<\Database\Factories\ProgressNoteFactory> */
    use HasFactory;

    public function patient(){
        return $this->belongsTo(Patient::class);
    }

    public function appointment(){
        return $this->belongsTo(Appointment::class);
    }

    public function profile(){
        return $this->belongsTo(Profile::class);
    }
}
