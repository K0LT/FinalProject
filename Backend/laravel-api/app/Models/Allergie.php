<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Allergie extends Model
{
    /** @use HasFactory<\Database\Factories\AllergieFactory> */
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
