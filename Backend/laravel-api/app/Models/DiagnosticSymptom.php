<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class DiagnosticSymptom extends Pivot
{
    use SoftDeletes;

    protected $table = 'diagnostic_symptom';

    protected $fillable = [
        'diagnostic_id',
        'symptom_id',
    ];
}
