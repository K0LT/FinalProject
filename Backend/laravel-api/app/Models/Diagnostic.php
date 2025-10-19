<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnostic extends Model
{
    /** @use HasFactory<\Database\Factories\DiagnosticFactory> */
    use HasFactory;


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
