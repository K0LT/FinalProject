<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Registo de novo utilizador (SPA + Sanctum com cookies).
     */
    public function register(Request $request)
    {
        $data = $request->validate([
            'name'                  => ['required', 'string', 'max:255'],
            'surname'               => ['nullable', 'string', 'max:255'],
            'email'                 => ['required', 'email', 'max:255', 'unique:users,email'],
            'password'              => ['required', 'string', 'min:8', 'confirmed'], // password_confirmation
        ]);

        // ⚠️ Escolhe o role "por defeito" para novos utilizadores
        // vê na tabela "roles" qual o ID que queres (por ex. 1 = paciente)
        $defaultRoleId = 3;

        $user = User::create([
            'role_id'  => $defaultRoleId,
            'name'     => $data['name'],
            'surname'  => $data['surname'] ?? '', // como a coluna NÃO é nullable
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return response()->json([
            'message' => 'Registo efectuado com sucesso.',
            'user'    => $user,
        ], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required', 'string'],
            'remember' => ['boolean'],
        ]);

        if (! Auth::attempt(
            ['email' => $credentials['email'], 'password' => $credentials['password']],
            $request->boolean('remember')
        )) {
            throw ValidationException::withMessages([
                'email' => 'As credenciais fornecidas não são válidas.',
            ]);
        }

        $request->session()->regenerate();

        return response()->json([
            'message' => 'Sessão iniciada com sucesso.',
            'user'    => $request->user(),
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
