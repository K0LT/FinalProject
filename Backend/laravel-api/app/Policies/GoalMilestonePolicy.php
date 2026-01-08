<?php

namespace App\Policies;

use App\Models\GoalMilestone;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class GoalMilestonePolicy
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
    public function view(User $user, GoalMilestone $goalMilestone): bool
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
    public function update(User $user, GoalMilestone $goalMilestone): bool
    {
        if($user->role->name === "Admin"){
            return true;
        }
        return false;
    }
    public function delete(User $user, GoalMilestone $goalMilestone): bool
    {
        if($user->role->name === "Admin"){
            return true;
        }
        return false;
    }
}

