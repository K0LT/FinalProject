<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeightTracking extends Model
{
    /** @use HasFactory<\Database\Factories\WeightTrackingFactory> */
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'weight',
        'body_fat_percentage',
        'measurement_date',
        'notes',
    ];

    public function patient(){
        return $this->belongsTo(Patient::class);
    }
}
