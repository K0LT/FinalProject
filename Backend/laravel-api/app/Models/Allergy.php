<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Allergy extends Model
{
    /** @use HasFactory<\Database\Factories\AllergyFactory> */
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'patient_id',
        'allergen',
        'reaction_type',
        'severity',
        'notes',
    ];

    public function patients()
    {
        return $this->belongsToMany(Patient::class, 'allergy_patient')
            ->using(AllergyPatient::class)
            ->withTimestamps()
            ->withPivot('deleted_at')
            ->wherePivotNull('deleted_at');
    }

}
