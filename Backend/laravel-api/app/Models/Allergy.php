<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Allergy extends Model
{
    /** @use HasFactory<\Database\Factories\AllergyFactory> */
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'allergen',
        'reaction_type',
        'severity',
        'notes',
    ];

    public function patient(){
        return $this->belongsTo(Patient::class);
    }

}
