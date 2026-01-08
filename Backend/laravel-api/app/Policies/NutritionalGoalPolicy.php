<?php

namespace App\Policies;

use App\Models\NutritionalGoal;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class NutritionalGoalPolicy
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
    public function view(User $user, NutritionalGoal $nutritionalGoal): bool
    {
        if($user->role->name === "Admin" || $user->patient->id === $nutritionalGoal->patient_id){
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
    public function update(User $user, NutritionalGoal $nutritionalGoal): bool
    {
        if($user->role->name === "Admin"){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, NutritionalGoal $nutritionalGoal): bool
    {
        if($user->role->name === "Admin"){
            return true;
        }
        return false;
    }

}
