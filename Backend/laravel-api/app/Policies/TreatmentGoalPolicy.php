<?php

namespace App\Policies;

use App\Models\TreatmentGoal;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TreatmentGoalPolicy
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
    public function view(User $user, TreatmentGoal $treatmentGoal): bool
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
    public function update(User $user, TreatmentGoal $treatmentGoal): bool
    {
        if($user->role->name === "Admin"){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, TreatmentGoal $treatmentGoal): bool
    {
        if($user->role->name === "Admin"){
            return true;
        }
        return false;
    }


}
