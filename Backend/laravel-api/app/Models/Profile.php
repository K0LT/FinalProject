<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    /** @use HasFactory<\Database\Factories\ProfileFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'specialty',
        'license_number',
        'phone',
        'address',
        'bio',
    ];

    public function user()
    {
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

    public function exercisePatients(){
        return $this->hasMany(ExercisePatient::class);
    }

    public function progressNotes(){
        return $this->hasMany(ProgressNote::class);
    }

}
