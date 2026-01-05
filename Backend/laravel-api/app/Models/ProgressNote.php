<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProgressNote extends Model
{
    /** @use HasFactory<\Database\Factories\ProgressNoteFactory> */
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'patient_id',
        'appointment_id',
        'note_date',
        'subjective',
        'objective',
        'assessment',
        'plan',
    ];

    public function patient(){
        return $this->belongsTo(Patient::class);
    }

    public function appointment(){
        return $this->belongsTo(Appointment::class);
    }

}
