<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Credenciais inválidas',
            ], 401);
        }

        $user = Auth::user();

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ]);
    }


    public function logout(Request $request)
    {
        // Remove apenas o token usado na requisição
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logout realizado com sucesso'
        ]);

    }
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|integer',
        ]);

        $user = \App\Models\User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id,
        ]);
//        if ($request->role_id == 3) {
//            \App\Models\Patient::create([
//                'user_id' => $user->id,
//                'phone_number' => $request->phone_number,
//                'client_since' => $request->client_since ?? now(),
//            ]);
//        }


        $user->sendEmailVerificationNotification();

        return response()->json([
            'message' => 'Conta criada com sucesso! Verifique o seu email para confirmar a conta.'
        ], 201);
    }

}
