<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class AllergyPatient extends Pivot
{
    use SoftDeletes;

    protected $table = 'allergy_patient';

    protected $fillable = [
        'patient_id',
        'allergy_id',
    ];
}
