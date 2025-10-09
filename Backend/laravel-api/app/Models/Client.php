<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    /** @use HasFactory<\Database\Factories\ClientFactory> */
    use HasFactory;

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    protected $fillable = [
        'user_id',
        'full_name',
        'email',
        'phone_number',
        'address',
        'birth_date',
        'age',
        'gender',
        'weight',
        'height',
        'emergency_contact_number',
        'health_objective',
    ];

}
