<?php

namespace App\Policies;

use App\Models\Symptom;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SymptomPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        if($user->role->name === "Admin"){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Symptom $symptom): bool
    {
        if($user->role->name === "Admin"){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if($user->role->name === "Admin"){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Symptom $symptom): bool
    {
        if($user->role->name === "Admin"){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Symptom $symptom): bool
    {
        if($user->role->name === "Admin"){
            return true;
        }
        return false;
    }

}
