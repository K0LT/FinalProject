<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Condition extends Model
{
    /** @use HasFactory<\Database\Factories\ConditionFactory> */
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'patient_id',
        'name',
        'diagnosed_date',
        'status',
    ];

    public function patient(){
        return $this->belongsTo(Patient::class);
    }
}
