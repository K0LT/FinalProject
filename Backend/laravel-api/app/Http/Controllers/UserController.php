<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\Patient;
use App\Models\Profile;
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

    public function store(StoreUserRequest $request){

        $roleId = $request->role_id ?? 2;

        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'password' => $request->password,
            'role_id' => $roleId,
        ]);

        if ($roleId == 2) {
            Profile::create([
                'user_id' => $user->id,
                'speciality' => $request->specialty ?? null,
                'license_number' => $request->license_number ?? null,
                'phone' => $request->phone ?? null,
                'address' => $request->address ?? null,
                'bio' => $request->bio ?? null,
            ]);
        }


        return response()->json($user->load('patient'), 201);

    }

    public function show(User $user)
    {
        return response()->json([
            'success' => true,
            'user' => $user->load('role', 'profiles', 'patient')
        ], 200);
    }
}


