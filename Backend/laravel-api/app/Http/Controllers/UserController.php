<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\Patient;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //

    public function index()
    {
        $users = User::with('role', 'patient')->get();

        return response()->json([
            'success' => true,
            'users' => $users
        ], 200);
    }

    public function store(StoreUserRequest $request)
    {
        $data = $request->validate([
            // User
            'name'     => 'required|string|max:255',
            'surname'  => 'nullable|string|max:255',
            'email'    => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role_id'  => 'nullable|integer|in:2',

            //Patientt
            'phone_number'             => 'required|string|max:20',
            'address'                  => 'required|string|max:255',
            'birth_date'               => 'nullable|date',
            'emergency_contact_name'   => 'nullable|string|max:255',
            'emergency_contact_phone'  => 'nullable|string|max:20',
            'emergency_contact_relation'=> 'nullable|string|max:255',
            'client_since'             => 'nullable|date',
            'last_visit'               => 'nullable|date',
            'next_appointment'         => 'nullable|date',
        ]);

        $roleId = 2;

        $user = User::create([
            'name'     => $request->name,
            'surname'  => $request->surname,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role_id'  => $roleId,
        ]);

        $patient = Patient::create([
            'user_id'                    => $user->id,
            'phone_number'               => $request->phone_number,
            'address'                    => $request->address,
            'birth_date'                 => $request->birth_date,
            'emergency_contact_name'     => $request->emergency_contact_name,
            'emergency_contact_phone'    => $request->emergency_contact_phone,
            'emergency_contact_relation' => $request->emergency_contact_relation,
            'client_since' => $request->client_since ?? now()
        ]);


        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user'  => $user->load('patient'),
            'token' => $token,
        ], 201);
    }

    public function show(User $user)
    {
        return response()->json([
            'success' => true,
            'user' => $user->load('role', 'profiles', 'patient')
        ], 200);
    }
}


