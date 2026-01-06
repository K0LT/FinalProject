<?php

namespace App\Policies;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AppointmentPolicy
{
    //Index
    public function viewAny(User $user): bool
    {
        if($user->role->name === "Admin"){
            return true;
        }
        return false;
    }

    //Show
    public function view(User $user, Appointment $appointment): bool
    {
        if($user->role->name === "Admin" || $user->patient->id === $appointment->patient_id){
            return true;
        }

        return false;
    }

    //Create
    public function create(User $user): bool
    {
        if($user->role->name === "Admin"){
            return true;
        }

        return false;
    }

    //Update
    public function update(User $user, Appointment $appointment): bool
    {
        if($user->role->name === "Admin"){
            return true;
        }

        return false;
    }

    ///SoftDelete
    public function delete(User $user, Appointment $appointment): bool
    {
        if($user->role->name === "Admin"){
            return true;
        }

        return false;
    }

    //IndexSoftDelete
    public function viewAnySoftDeleted(User $user): bool
    {
        if($user->role->name === "Admin"){
            return true;
        }

        return false;
    }
}
