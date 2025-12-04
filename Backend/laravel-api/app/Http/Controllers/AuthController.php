<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\RegisterUserRequest;


class AuthController extends Controller
{

    public function register(RegisterUserRequest $request)
    {
        $roleId = $request->role_id ?? 3;
        $validated = $request->validated();

        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'password' => $request->password,
            'role_id' => $roleId,
        ]);

        if ($roleId == 3) {
            Patient::create([
                'user_id' => $user->id,
                'phone_number' => $request->phone_number,
                'client_since' => $request->client_since ?? now(),
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Registo efectuado com sucesso.',
            'user'    => $user,
            'token'   => $token
        ], 201);
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);


        $user = User::where('email', $validated['email'])->first();


        if (!$user || !Hash::check($validated['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => 'As credenciais fornecidas não são válidas.',
            ]);
        }

        Auth::login($user);
        $request->session()?->regenerate();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login efetuado com sucesso.',
            'user'    => $user,
            'token'   => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'message' => 'Sessão terminada com sucesso.',
        ]);
    }
}
