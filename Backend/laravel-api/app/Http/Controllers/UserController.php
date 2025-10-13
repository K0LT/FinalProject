<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function index()
    {
        $users = User::with('role', 'profiles', 'patient')->get();

        return response()->json([
            'success' => true,
            'users' => $users
        ], 200);
    }

    public function show(User $user)
    {
        return response()->json([
            'success' => true,
            'user' => $user->load('role', 'profiles', 'patient') // traz relações
        ], 200);
    }
}


