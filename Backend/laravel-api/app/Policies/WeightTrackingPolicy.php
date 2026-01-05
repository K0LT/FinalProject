<?php

namespace App\Policies;

use App\Models\User;
use App\Models\WeightTracking;
use Illuminate\Auth\Access\Response;

class WeightTrackingPolicy
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
    public function view(User $user, WeightTracking $weightTracking): bool
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
    public function update(User $user, WeightTracking $weightTracking): bool
    {
        if($user->role->name === "Admin"){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, WeightTracking $weightTracking): bool
    {
        if($user->role->name === "Admin"){
            return true;
        }
        return false;
    }
}
