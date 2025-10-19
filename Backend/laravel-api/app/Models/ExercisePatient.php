<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExercisePatient extends Model
{
    /** @use HasFactory<\Database\Factories\ExercisePatientFactory> */
    use HasFactory;

    public function profile(){
        return $this->belongsTo(Profile::class);
    }
}
