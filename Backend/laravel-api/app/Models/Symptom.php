<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Symptom extends Model
{
    /** @use HasFactory<\Database\Factories\SymptomFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description'
        ];


    public function diagnostics()
    {
        return $this->belongsToMany(Diagnostic::class, 'diagnostic_symptom')->withTimestamps();
    }
}
